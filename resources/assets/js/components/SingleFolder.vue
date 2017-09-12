<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <dropzone id="myVueDropzone" ref="myVueDropzone" url="/UploadImages" :maxFileSizeInMB="10" acceptedFileTypes=".png,.jpg,.jpeg" :headers="csrfHeader" v-on:vdropzone-success="showSuccess">
                        <!-- csrf token for laravel -->
                        <input type="hidden" name="csrf-token" :value="csrfToken">
                        <input type="hidden" name="folderid" :value="folderid">
                    </dropzone>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3" v-for="image in images" style="margin-bottom: 10px;">
                    <div class="card">
                        <img class="card-img-top" :src="image.image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Dropzone from 'vue2-dropzone';
export default {
    data () {
        return {
            csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
            csrfHeader: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            },
            folderid: this.$route.params.id,
            images: {},
        }
    },
    mounted () {
        this.getImages();
    },
    components: {
        Dropzone
    },
    methods: {
        'showSuccess': function (file) {
            var image =  JSON.parse(file.xhr.response);
            console.log(image);
            this.images.unshift(image);
        },
        getImages () {
            axios.get('/getFolderImages/' + this.$route.params.id).then(({data}) => {
                this.images = data.images;
            }).catch(error => {
                alert("There is some error");
                // window.location = '/';
            });
        }
    }
}
</script>

<style lang="css">
html {
    font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
    font-size: 14px;
}

h5 {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
    margin: 0;
}

.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: 250px;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}
</style>
