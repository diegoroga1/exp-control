<script>
export default {
    name: "NewTransactionFloatingButton"
}
</script>

<template>

    <div class="position-absolute floating-add-button">
        <button class="btn  ">
            <i class="fa fa-plus "></i>
        </button>
    </div>
</template>

<style scoped lang="scss">

.floating-add-button{
    position:fixed;
    bottom:10%;
    right:5%;
    button{
        box-shadow:0px 2px 10px 5px lightgray;
        width:80px;
        height: 80px;
        border-radius:50%;
        background-color:#4CAF50;
        color:white;
        i{
            font-size:2rem;
        }
    }
}
</style>
