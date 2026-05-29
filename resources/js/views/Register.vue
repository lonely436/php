<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">注册</div>
                    <div class="card-body">
                        <div v-if="error" class="alert alert-danger">
                            {{ error }}
                        </div>
                        <div v-if="success" class="alert alert-success">
                            {{ success }}
                        </div>
                        <form @submit.prevent="handleRegister">
                            <div class="form-group">
                                <label for="name">用户名 <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    v-model="form.name" 
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">邮箱 <span class="text-danger">*</span></label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    v-model="form.email" 
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="password">密码 <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    v-model="form.password" 
                                    class="form-control"
                                    required
                                    minlength="6"
                                />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">确认密码 <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    v-model="form.password_confirmation" 
                                    class="form-control"
                                    required
                                />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">注册</button>
                        </form>
                        <p class="mt-3 text-center">
                            已有账号？<router-link to="/login">立即登录</router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: 'Register',
    setup() {
        const router = useRouter();
        const form = reactive({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });
        
        const error = ref('');
        const success = ref('');

        const handleRegister = async () => {
            error.value = '';
            success.value = '';
            
            if (form.password !== form.password_confirmation) {
                error.value = '两次输入的密码不一致';
                return;
            }

            try {
                const response = await axios.post('/api/register', form);
                success.value = response.data.message;
                setTimeout(() => {
                    router.push('/login');
                }, 1500);
            } catch (err) {
                const errors = err.response?.data?.errors;
                if (errors) {
                    error.value = Object.values(errors).flat().join(' ');
                } else {
                    error.value = '注册失败';
                }
            }
        };

        return {
            form,
            error,
            success,
            handleRegister,
        };
    },
};
</script>
