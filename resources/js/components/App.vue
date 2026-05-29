<template>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <router-link to="/enterprise" class="navbar-brand">
                        广东名企网
                    </router-link>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <router-link to="/enterprise">
                            <i class="glyphicon glyphicon-th-list"></i> 企业列表
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/enterprise/create">
                            <i class="glyphicon glyphicon-plus"></i> 添加企业
                        </router-link>
                    </li>
                    <li v-if="!currentUser">
                        <router-link to="/login">
                            <i class="glyphicon glyphicon-log-in"></i> 登录
                        </router-link>
                    </li>
                    <li v-if="!currentUser">
                        <router-link to="/register">
                            <i class="glyphicon glyphicon-user"></i> 注册
                        </router-link>
                    </li>
                    <li v-if="currentUser" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i> {{ currentUser.name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" @click.prevent="handleLogout">退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <router-view></router-view>
        </main>

        <footer class="footer">
            <div class="container text-center">
                <p>&copy; 2026 广东名企网。All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: 'App',
    setup() {
        const router = useRouter();
        const currentUser = ref(null);

        const loadUser = () => {
            const user = localStorage.getItem('user');
            if (user) {
                currentUser.value = JSON.parse(user);
            } else {
                currentUser.value = null;
            }
        };

        onMounted(() => {
            loadUser();
            window.addEventListener('storage', loadUser);
        });

        const handleLogout = async () => {
            try {
                await axios.post('/api/logout');
            } catch (err) {
                console.error('Logout error:', err);
            } finally {
                localStorage.removeItem('user');
                currentUser.value = null;
                router.push('/login');
            }
        };

        return {
            currentUser,
            handleLogout,
        };
    },
};
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Microsoft YaHei", Arial, sans-serif;
    background-color: #f5f5f5;
}

#app {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.navbar {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 0;
}

.navbar-brand {
    font-weight: bold;
    color: #333 !important;
}

.navbar-default .navbar-nav > li > a {
    color: #666;
    transition: color 0.3s;
}

.navbar-default .navbar-nav > li > a:hover {
    color: #337ab7;
}

.content {
    flex: 1;
    padding: 30px 0;
    background-color: #fff;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    margin-top: auto;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}

.text-center {
    text-align: center;
}
</style>