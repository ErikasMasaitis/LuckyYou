<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">About</div>
                <div v-if="user" class="card">
                    <div class="card-body">
                    <p>Lucky you - try your best today!</p>
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
        user: {
            user: null,
            default: null
        },
    }
}
</script>
