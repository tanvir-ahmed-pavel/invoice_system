<template>
    <div class="form-group mb-0">
        <div class="input-group-sm input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-default"><i class="fas fa-search"></i></span>
            </div>

            <input v-model="query" @input="evnt_searchFilter(false)" @keyup.enter="evnt_searchFilter(true)" class="form-control-sm form-control bg-secondary text-default" placeholder="Search all columns" type="text">
            <div class="input-group-append" v-if="query">
                    <button class="btn btn-sm btn-light" type="button" @click="clearSearch">Clear</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchFilterComponent",
        data(){
            return{
                query:"",
                status:true,
                interval:setInterval(() => {
                    this.status= true;
                }, 200)
            }
        },
        methods:{
            clearSearch(){
                this.query="";
                this.evnt_searchFilter();
            },
            evnt_searchFilter(i){
                if(this.status||i||this.query==""){
                    this.$emit("searchFilter", this.query)
                    this.status=false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
