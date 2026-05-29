<template>
    <div class="container">
        <div v-if="loading" class="text-center">
            <p>加载中...</p>
        </div>

        <div v-else-if="error" class="alert alert-danger">
            {{ error }}
        </div>

        <div v-else-if="enterprise" class="enterprise-detail">
            <div class="page-header">
                <h1>{{ enterprise.name }}</h1>
                <div>
                    <router-link :to="`/enterprise/${enterprise.id}/edit`" class="btn btn-warning">
                        编辑
                    </router-link>
                    <router-link to="/enterprise" class="btn btn-default">
                        返回列表
                    </router-link>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div v-if="enterprise.image" class="thumbnail">
                        <img :src="getImageUrl(enterprise.image)" alt="企业图片" style="max-width: 100%; height: auto;" />
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th width="120">企业简称</th>
                            <td>{{ enterprise.abbreviate }}</td>
                        </tr>
                        <tr>
                            <th>企业理念</th>
                            <td>{{ enterprise.philosophy }}</td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>{{ enterprise.id }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="description">
                <h3>企业描述</h3>
                <p>{{ enterprise.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import enterpriseApi from '../api/enterprise';

export default {
    name: 'EnterpriseDetail',
    data() {
        return {
            enterprise: null,
            loading: false,
            error: null,
        };
    },
    created() {
        this.fetchEnterprise();
    },
    methods: {
        async fetchEnterprise() {
            this.loading = true;
            this.error = null;
            try {
                const response = await enterpriseApi.getById(this.$route.params.id);
                this.enterprise = response.data.data;
            } catch (err) {
                this.error = '加载企业详情失败';
                console.error(err);
            } finally {
                this.loading = false;
            }
        },
        getImageUrl(imagePath) {
            if (imagePath && imagePath.startsWith('/')) {
                return imagePath;
            }
            return '/images/placeholder.jpg';
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

.thumbnail {
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px;
}

.description {
    margin-top: 30px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 4px;
}

.description h3 {
    margin-top: 0;
    margin-bottom: 15px;
}

.description p {
    line-height: 1.8;
    white-space: pre-wrap;
}
</style>