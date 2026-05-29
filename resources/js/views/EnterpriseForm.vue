<template>
    <div class="container">
        <div class="page-header">
            <h1>{{ isEdit ? '编辑企业' : '添加企业' }}</h1>
            <router-link to="/enterprise" class="btn btn-default">
                返回列表
            </router-link>
        </div>

        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="name">企业名称 <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    v-model="form.name" 
                    class="form-control" 
                    placeholder="请输入企业名称"
                    required
                />
            </div>

            <div class="form-group">
                <label for="abbreviate">企业简称 <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="abbreviate" 
                    v-model="form.abbreviate" 
                    class="form-control" 
                    placeholder="请输入企业简称"
                    required
                />
            </div>

            <div class="form-group">
                <label for="philosophy">企业理念 <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="philosophy" 
                    v-model="form.philosophy" 
                    class="form-control" 
                    placeholder="请输入企业理念"
                    required
                />
            </div>

            <div class="form-group">
                <label for="image">企业图片 <span class="text-danger">*</span></label>
                <input 
                    type="file" 
                    id="image" 
                    @change="handleImageChange" 
                    class="form-control"
                    accept="image/*"
                    :required="!isEdit || !form.image"
                />
                <div v-if="form.image || previewImage" class="thumbnail" style="margin-top: 10px;">
                    <img :src="previewImage || getImageUrl(form.image)" alt="预览" style="max-width: 200px; height: auto;" />
                </div>
                <p v-if="!isEdit && !imageFile && !form.image" class="text-danger" style="margin-top: 5px;">
                    请上传一张图片
                </p>
            </div>

            <div class="form-group">
                <label for="description">企业描述 <span class="text-danger">*</span></label>
                <textarea 
                    id="description" 
                    v-model="form.description" 
                    class="form-control" 
                    rows="6"
                    placeholder="请输入企业描述"
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" :disabled="submitting">
                    {{ submitting ? '提交中...' : (isEdit ? '更新' : '创建') }}
                </button>
                <router-link to="/enterprise" class="btn btn-default" style="margin-left: 10px;">
                    取消
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import enterpriseApi from '../api/enterprise';

export default {
    name: 'EnterpriseForm',
    data() {
        return {
            form: {
                name: '',
                abbreviate: '',
                philosophy: '',
                description: '',
                image: null,
            },
            imageFile: null,
            previewImage: null,
            submitting: false,
        };
    },
    computed: {
        isEdit() {
            return !!this.$route.params.id;
        },
    },
    created() {
        if (this.isEdit) {
            this.fetchEnterprise();
        }
    },
    methods: {
        async fetchEnterprise() {
            try {
                const response = await enterpriseApi.getById(this.$route.params.id);
                const data = response.data.data;
                this.form = {
                    name: data.name,
                    abbreviate: data.abbreviate,
                    philosophy: data.philosophy,
                    description: data.description,
                    image: data.image,
                };
                this.previewImage = data.image ? this.getImageUrl(data.image) : null;
            } catch (err) {
                alert('加载企业信息失败');
                console.error(err);
            }
        },
        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageFile = file;
                this.previewImage = URL.createObjectURL(file);
            }
        },
        getImageUrl(imagePath) {
            if (imagePath && imagePath.startsWith('/')) {
                return imagePath;
            }
            return '/images/placeholder.jpg';
        },
        async handleSubmit() {
            this.submitting = true;
            try {
                const formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('abbreviate', this.form.abbreviate);
                formData.append('philosophy', this.form.philosophy);
                formData.append('description', this.form.description);
                
                if (this.imageFile) {
                    formData.append('image', this.imageFile);
                }

                if (this.isEdit) {
                    await enterpriseApi.update(this.$route.params.id, formData);
                    alert('更新成功');
                } else {
                    await enterpriseApi.create(formData);
                    alert('创建成功');
                }
                this.$router.push('/enterprise');
            } catch (err) {
                alert(this.isEdit ? '更新失败' : '创建失败');
                console.error(err);
            } finally {
                this.submitting = false;
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

.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
}

.thumbnail {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    display: inline-block;
}

.text-danger {
    color: #d9534f;
}
</style>