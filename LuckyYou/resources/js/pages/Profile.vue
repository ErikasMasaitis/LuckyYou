<template>
    <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
          <form @submit="formSubmit" enctype="multipart/form-data">
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Update an account</h1></div>
            <span>
               <b-alert v-if="succesfull" variant="success" show>Profile updated</b-alert>
              <b-alert v-if="errors.length" variant="danger" show>error occured</b-alert>
                     <span class="w-full text-red-500" v-if="errors.email">{{errors.email[0]}}</span>

            </span>
            <div class="p-2 w-full">
                <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
                <label class="w-full" for="name">Name</label>
                <input class="form-control" placeholder="Name" id="name" name="name" type="text" v-model="form.name" >
            </div>
            <div class="p-2 w-full">
                <span class="w-full text-red-500" v-if="errors.email">{{errors.email[0]}}</span>

                <label for="email">Your e-mail</label>
                <input class="form-control" placeholder="Email" id="email" name="email" type="email" v-model="form.email">
            </div>
            <div class="p-2 w-full">
                <label for="password">Password</label>
                <input class="form-control" placeholder="Password" id="password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-full">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-control" placeholder="Confirm Password" id="confirm_password" type="password" v-model="form.password_confirmation" name="password_confirmation">
            </div>

            <div class="p-2 w-full">
                <label>Image</label>
                <input class="form-control" type="file" v-on:change="onImageChange">
            </div>
            <div class="p-2 w-full mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                photo: ''
            },
            succesfull: null,
            errors: []
        }
    },
    props: {
      user: null
    },
    created() {
      this.getUser()
      this.succesfull();
    },
    methods:{
        getUser() {
          axios.get('/api/profile', this.form).then((res) =>{
            this.form.name = res.data.name;
            this.form.email = res.data.email;
          }).catch((error) =>{
            this.errors = error.response.data.errors
            console.log(error.response.data)
          })
        },
      succesfull(){
        this.succesfull = "Profile updated";
      },
      onImageChange(e){
        console.log(e.target.files[0]);
        this.form.photo = e.target.files[0];
      },
      formSubmit(e) {
        e.preventDefault();

        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }

        let formData = new FormData();
        formData.append('photo', this.form.photo);
        formData.append('name', this.form.name);
        formData.append('email', this.form.email);
        formData.append('password', this.form.password);
        formData.append('password_confirmation', this.form.password_confirmation);

        axios.post('/api/update', formData).then(() =>{
         // location.reload();
          this.succesfull = "Profile updated";
          // this.$router.push({name: 'home'})
        }).catch((error) =>{
          this.errors = error.response.data.errors;
          console.log(error.response.data)
        })
      }
    }
}
</script>
