<template>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item" v-for="folder in folders">
                    <router-link :to="{name: 'SingleFolder', params: {id: folder.id, name: folder.name}}">
                        {{ folder.name }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            folders: {},
        }
    },
    mounted () {
        var self = this;
        this.AllFolders();
        Event.listen('folder-added', function (folder) {
            (self.folders).push(folder);
        });
    },
    methods: {
        AllFolders () {
            axios.get('AllFolders').then(({data}) => {
                this.folders = data.folders;
            }).catch(error => {
                alert("There is some error");
                window.location = '/';
            });
        }
    }
}
</script>


<style media="screen">
    .btn {
        margin-left: 3px;
    }
</style>
