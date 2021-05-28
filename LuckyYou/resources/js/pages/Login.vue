<template>
    <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Login to your account</h1></div>
            <div class="p-2 w-full">
                <span class="alert-danger" v-if="errors.email">{{errors.email[0]}}</span>
                <p></p>
                <label for="email">Your e-mail</label>
                <input name="email" id="email" class="form-control" placeholder="Email" type="email" v-model="form.email">
            </div>
            <div class="p-2 w-full">
                <label for="password">Password</label>
                <input id="password" class="form-control" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-full mt-4">
                <button @click.prevent="loginUser" type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {

    data(){
        return{
            form: {
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods:{
        loginUser(){
            axios.post('/api/login', this.form).then((res)=>{
                    this.$router.push({name: 'about'})
                    location.reload();
                    this.loading = true;
            }).catch(err =>  {
                this.errors = err.response.data.errors
                console.log(this.errors)
            })
        }
    }
}
</script>
