<script>
export default {
    name: "TransactionNavbar"
}
</script>

<template>
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link active " aria-current="page"  id="pill-tab-0" data-bs-toggle="pill" href="#pill-tabpanel-0" role="tab" aria-controls="pill-tabpanel-0" aria-selected="true">
            <span>Personal</span>
            <small><b>Individual</b></small>
        </a>
        <a class="nav-link " id="pill-tab-1" data-bs-toggle="pill" href="#pill-tabpanel-1" role="tab" aria-controls="pill-tabpanel-1" aria-selected="false">
            <span>Allacher Strasse</span>
            <small><b>Group</b></small>
        </a>
        <a class="nav-link "  id="pill-tab-2" data-bs-toggle="pill" href="#pill-tabpanel-2" role="tab" aria-controls="pill-tabpanel-2" aria-selected="false">
            <span class="text-info"><i><i class="fa fa-plus-circle mr-2"></i>Add group</i></span><br>
        </a>
    </nav>
</template>

<style scoped lang="scss">

</style>
