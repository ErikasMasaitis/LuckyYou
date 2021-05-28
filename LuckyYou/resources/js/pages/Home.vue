<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">Home</div>
                <div v-if="user" class="card">
                    <div class="card-body">
                        <p>Your name: {{ user.name }}</p>
                        <p>Your email: {{ user.email }}</p>
                        <p>You are: {{ user.role }}</p>
                        <p>Your balance:  {{ user.balance }}</p>
                        <p>Your win count:  {{ user.wins }}</p>
                    </div>
                  <div>
                    You can:
                    <div>
                      <router-link  :to="{ name: 'games' }" tag="button" class="btn btn-primary">Play games</router-link>
                      <router-link  :to="{ name: 'profile' }" tag="button" class="btn btn-primary">Check your profile </router-link>
                      <router-link  :to="{ name: 'achievements' }" tag="button" class="btn btn-primary">Check your achievements </router-link>
                      <router-link  :to="{ name: 'userhistory' }" tag="button" class="btn btn-primary">Check your games history </router-link>
                    </div>



                  </div>
                </div>
                <div v-else>
                    Please login before....
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: null
    }
}
</script>
