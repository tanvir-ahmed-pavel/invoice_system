<template>
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ 'ADD New Driver'}}</h5>
                </div>

                <form method="post" action="" autocomplete="off">
                    <div class="card-body row">
                        <div class="form-group col-md-10 col-auto text-right">
                        </div>
                        <div class="form-group col-md-2 col-auto text-right">
                            <input class="form-control bg-default" type="date" v-model="myDate" name="date">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-12">{{ 'TO' }}</label>
                            <select class="custom-select bg-default col-md-8 mr-2">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                            </select>
                            <a href="" class="btn btn-outline-default">Add a client</a>
                        </div>

                        <div class="form-group col-md-6 text-right">
                            <label class="col-md-12">{{ 'From' }}</label>
                            <select class="custom-select bg-default col-md-7 mr-2">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                            </select>
                            <a href="" class="btn btn-outline-default">Add a Company</a>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-md-12">{{ 'Subject' }}</label>
                            <input class="form-control bg-default" type="text" name="subject">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InvoiceComponent",
        data(){
            return{
                myDate : new Date().toISOString().slice(0,10),
            }
        }
    }
</script>

<style scoped>

</style>
