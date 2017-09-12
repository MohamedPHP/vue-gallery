<template>
    <div class="row">
        <div class="col-md-4">
            <h4>My Folders</h4>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" v-model="foldername" class="form-control" id="" placeholder="Folder name..">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" @click="AddFolder" class="btn btn-primary">Create Folder</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            foldername: '',
        }
    },
    mounted () {

    },
    methods: {
        AddFolder () {
            axios.post('CreateFolder', {
                name: this.foldername,
            }).then(({data}) => {
                alert('You Added The Folder');
                Event.fire('folder-added', data.folder);
            }).catch(error => {
                alert(error.response.data.message);
            });
        }
    }
}
</script>
