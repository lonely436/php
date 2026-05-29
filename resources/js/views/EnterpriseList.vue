<template>
    <div class="container">
        <div class="page-header">
            <h1>广东名企</h1>
            <router-link to="/enterprise/create" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> 添加企业
            </router-link>
        </div>

        <div v-if="loading" class="text-center">
            <p>加载中...</p>
        </div>

        <div v-else-if="error" class="alert alert-danger">
            {{ error }}
        </div>

        <div v-else class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>企业名称</th>
                        <th>简称</th>
                        <th>企业理念</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="enterprise in enterprises" :key="enterprise.id">
                        <td>{{ enterprise.id }}</td>
                        <td>{{ enterprise.name }}</td>
                        <td>{{ enterprise.abbreviate }}</td>
                        <td>{{ enterprise.philosophy }}</td>
                        <td>
                            <router-link :to="`/enterprise/${enterprise.id}`" class="btn btn-sm btn-info">
                                查看
                            </router-link>
                            <router-link :to="`/enterprise/${enterprise.id}/edit`" class="btn btn-sm btn-warning">
                                编辑
                            </router-link>
                            <button @click="handleDelete(enterprise.id)" class="btn btn-sm btn-danger">
                                删除
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="enterprises.length === 0" class="text-center">
                <p>暂无企业数据</p>
            </div>
        </div>
    </div>
</template>

<script>
import enterpriseApi from '../api/enterprise';

export default {
    name: 'EnterpriseList',
    data() {
        return {
            enterprises: [],
            loading: false,
            error: null,
        };
    },
    created() {
        this.fetchEnterprises();
    },
    methods: {
        async fetchEnterprises() {
            this.loading = true;
            this.error = null;
            try {
                const response = await enterpriseApi.getAll();
                this.enterprises = response.data.data || [];
            } catch (err) {
                this.error = '加载企业列表失败';
                console.error(err);
            } finally {
                this.loading = false;
            }
        },
        async handleDelete(id) {
            if (!confirm('确定要删除这个企业吗？')) {
                return;
            }

            try {
                await enterpriseApi.delete(id);
                alert('删除成功');
                this.fetchEnterprises();
            } catch (err) {
                alert('删除失败');
                console.error(err);
            }
        },
    },
};
</script>

<style scoped>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.table {
    margin-top: 20px;
}

.btn {
    margin-right: 5px;
}
</style>