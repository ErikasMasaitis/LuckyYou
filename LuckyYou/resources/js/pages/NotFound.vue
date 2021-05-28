<template>
    <div id="main" class="d-flex justify-content-center align-items-center flex-column">
        <div  class="d-flex justify-content-center align-items-center">
            <h1 class="mr-3 pr-3 align-top border-right inline-block">404</h1>
            <div class="inline-block align-middle">
                <h2 class="font-weight-normal lead">The page you were looking for was not found.</h2>
            </div>
        </div>

        <div>
            <a class="btn btn-primary" href="#" @click.prevent="$router.go(-1)"> Go back </a>
        </div>

    </div>

</template>

<style scoped>
#main {
  height: 70vh;
}
</style>


<script>
export default {
}
</script>