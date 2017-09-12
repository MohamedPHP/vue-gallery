<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        <AddFolders></AddFolders>
                        <AllFolders></AllFolders>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddFolders from './Parts/AddFolders.vue';
    import AllFolders from './Parts/AllFolders.vue';
    export default {
        components: {
            AllFolders: AllFolders,
            AddFolders: AddFolders,
        },
        mounted() {

        }
    }
</script>
