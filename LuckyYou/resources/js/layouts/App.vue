<template>
    <div>
        <nav :disabled="loading" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <router-link :to="{ name: 'home' }" class="navbar-brand">LuckyYou</router-link>
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div  id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'home' }">
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'about' }">
                            About
                        </router-link>
                    </li>


                    <li v-if="!user" class="nav-item">
                        <a href="/login" class="nav-link active router-link-active" aria-current="page">
                            Login
                        </a>
                    </li>

                    <li v-if="!user" class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'register' }">
                            Register
                        </router-link>
                    </li>
                    <li v-if="user" class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'games' }">
                            Games
                        </router-link>
                    </li>
                    <li v-if="user" class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'achievements' }">
                            Achievements
                        </router-link>
                    </li>
                    <li v-if="admin === 'admin'" class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'users' }"
                        >
                            Users
                        </router-link>
                    </li>
                  <li v-if="admin === 'admin'" class="nav-item">
                    <router-link
                        class="nav-link"
                        data-toggle="collapse"
                        :to="{ name: 'history' }"
                    >
                      History
                    </router-link>
                  </li>
                  <li v-if="user" class="nav-item">
                    <router-link
                        class="nav-link"
                        data-toggle="collapse"
                        :to="{ name: 'userhistory' }"
                    >
                     winnings history
                    </router-link>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                    <div v-if="user" class="d-flex justify-content-right align-items-center">
                    <b-dropdown class="m-md-2">
                        <template #button-content>
                           {{ user.name}}
                        </template>
                      <b-dropdown-item>
                  <li v-if="user" class="nav-item">
                    <router-link
                        class="nav-link"
                        data-toggle="collapse"
                        :to="{ name: 'profile' }">
                      Profile
                    </router-link>
                  </li>
                  </b-dropdown-item>
                  <div class="dropdown-divider"></div>
                        <b-dropdown-item><li v-if="user" class="nav-item" >
                            <a @click="logout" href="#/" class="nav-link">Logout</a>
                        </li></b-dropdown-item>
                    </b-dropdown>
                    </div>

            </li>
            <li>   <p v-if="admin || user"> <img :src="user.photo" style="width: 50px;"></p></li>
                </ul>
            </div>
        </nav>



        <div class="container">
            <router-view :user="user"></router-view>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return{
            user: null,
            admin: null,
            loading: false
        }
    },
    created() {
        axios.get('/api/user').then((res)=>{
            this.user = res.data
            this.admin = res.data.role
        })
    },
    methods:{
        logout(){
            axios.post('/api/logout').then((res)=>{
                if (res.status == 200) {
                    this.$router.push({name: 'login'});
                    this.loading = true;
                    location.reload();
                }
            }).catch((error) =>{
                this.errors = error.response.data.errors;
                this.loading = false;
                //<div id="{{ val }}">, use <div :id="val">.
            })
        }
    }
};
</script>
