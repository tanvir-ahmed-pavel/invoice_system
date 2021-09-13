<template>
    <div class="col-md-4">
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-danger">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="py-2 text-center">
                            <i class="fas fa-exclamation-triangle fa-3x text-yellow"></i>
                            <h4 class="heading mt-4">
                                <slot name="title"></slot>
                            </h4>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <slot name="actionButton"></slot>

                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ConfirmationModal"
    }
</script>

<style scoped>

</style>
