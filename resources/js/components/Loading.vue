<template>
    <div class="d-flex justify-content-center"
         style="min-height: 75%; min-height: 75vh;
              display: flex; align-items: center;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>
<script>
export default {
    name: "loader",
    props: {
        isVisible: {type: Boolean, required: true, default: false},
        text: {type: String, required: false, default: ""},
    },
    created() {
        console.log('dasjodiasjdo');
    }
}
</script>
