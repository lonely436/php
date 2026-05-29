<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">登录</div>
                    <div class="card-body">
                        <div v-if="error" class="alert alert-danger">
                            {{ error }}
                        </div>
                        <form @submit.prevent="handleLogin">
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
                                />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">登录</button>
                        </form>
                        <p class="mt-3 text-center">
                            还没有账号？<router-link to="/register">立即注册</router-link>
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
    name: 'Login',
    setup() {
        const router = useRouter();
        const form = reactive({
            email: '',
            password: '',
        });
        
        const error = ref('');

        const handleLogin = async () => {
            error.value = '';
            try {
                const response = await axios.post('/api/login', form);
                localStorage.setItem('user', JSON.stringify(response.data.user));
                window.dispatchEvent(new Event('storage'));
                alert(response.data.message);
                router.push('/enterprise');
            } catch (err) {
                error.value = err.response?.data?.error || '登录失败';
            }
        };

        return {
            form,
            error,
            handleLogin,
        };
    },
};
</script>
