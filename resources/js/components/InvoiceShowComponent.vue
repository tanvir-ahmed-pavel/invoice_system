<template>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">

                    <div class="card-body">
                        <div class="row">

                            <!--                                Invoice from-->

                            <div class="col-md-6">
                                <div v-if="Invoice.company">
                                        <span
                                            class="border-success text-success border rounded-0 p-1"><strong>Invoice From:</strong></span>
                                    <address class="mt-3 d-block">
                                        <div v-if="Invoice.company.company_name">
                                            <strong>{{Invoice.company.company_name}}</strong><br>
                                        </div>
                                        <div v-if="Invoice.company.company_address">
                                            {{Invoice.company.company_address}}
                                        </div>
                                        <div v-if="Invoice.company.company_contact">
                                            <abbr><b>Mobile: </b></abbr> {{Invoice.company.company_contact}}
                                        </div>
                                        <div v-if="Invoice.company.company_email">
                                            <abbr><b>Email: </b></abbr>{{Invoice.company.company_email}}
                                        </div>
                                        <div v-if="Invoice.company.company_website">
                                            <abbr><b>Website: </b></abbr>{{Invoice.company.company_website}}
                                        </div>
                                    </address>
                                </div>
                                <div class="mt-3" v-if="Invoice.subject">
                                    <abbr><b>Subject: </b></abbr>{{Invoice.subject}}
                                </div>

                            </div>

                            <!--                                Invoice To-->

                            <div class="col-md-6 text-left">
                                <div v-if="Invoice.client">
                                        <span
                                            class="border-success text-success border rounded-0 p-1"><strong>Invoice To:</strong></span>
                                    <address class="mt-3 d-block">
                                        <div v-if="Invoice.client.client_name">
                                            <strong>{{Invoice.client.client_name}}</strong><br>
                                        </div>
                                        <div v-if="Invoice.client.client_address">
                                            {{Invoice.client.client_address}}
                                        </div>
                                        <div v-if="Invoice.client.client_contact">
                                            <abbr><b>Mobile: </b></abbr> {{Invoice.client.client_contact}}
                                        </div>
                                        <div v-if="Invoice.client.client_email">
                                            <abbr><b>Email: </b></abbr>{{Invoice.client.client_email}}
                                        </div>
                                        <div v-if="Invoice.client.client_website">
                                            <abbr><b>Website: </b></abbr>{{Invoice.client.client_website}}
                                        </div>
                                    </address>
                                </div>

                                <!--                                    Invoice Date and ID-->

                                <div class="mt-3 "><strong>Invoice No: </strong>{{Invoice.invoice_number}}</div>
                                <div class="m-b-15"><strong>Invoice Date: </strong>{{Invoice.date}}</div>
                            </div>
                        </div>
                        <hr>

                        <!--                            Items Table-->

                        <div class="mb-4 table-responsive table-sm">
                            <table class="table table-striped table-sm table-responsive-lg">
                                <thead>
                                <tr>
                                    <th class="text-left"><strong>SL.</strong></th>
                                    <th class="text-left"><strong>Description</strong></th>
                                    <th class="text-center"><strong>Quantity</strong></th>
                                    <th class="text-center"><strong>Unit</strong></th>
                                    <th class="text-right"><strong>Rate</strong></th>
                                    <th class="text-right"><strong>Amount</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in Invoice.items">
                                    <td class="text-left">{{index+1}}</td>
                                    <td style="white-space:pre-wrap; word-wrap:break-word; max-width: 250px" class="text-left">
                                        <div>{{item.description? item.description : '-'}}</div>
                                    </td>
                                    <td class="text-center">{{item.quantity? item.quantity : '-'}}</td>
                                    <td class="text-center">{{item.unit? item.unit : '-'}}</td>
                                    <td class="text-right">{{item.rate? item.rate.toFixed(2) : '-'}}</td>
                                    <td class="text-right">{{item.amount? item.amount.toFixed(2) : '-'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!--                                    Amounts-->

                        <div class="row mt-3">
                            <div class="col-lg-8">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                    book.</p>
                                <p><strong>Thank you very much for choosing us.</strong></p>
                            </div>
                            <div class="col-lg-4">
                                <table class="table table-sm">
                                    <tbody>
                                    <tr class="text-right">
                                        <th>Total:</th>
                                        <td>{{'BDT '}}{{Invoice.sub_total.toFixed(2)}}</td>
                                    </tr>
                                    <tr class="text-right" v-if="Invoice.tax">
                                        <th class="border-0">TAX:</th>
                                        <td class="border-0">{{'BDT'}}{{((Invoice.tax/100)*Invoice.sub_total).toFixed(2)}}
                                        </td>
                                    </tr>
                                    <tr class="text-right" v-if="Invoice.vat">
                                        <th class="border-0">VAT:</th>
                                        <td class="border-0">{{'BDT '}}{{((Invoice.vat/100)*Invoice.sub_total).toFixed(2)}}
                                        </td>
                                    </tr>
                                    <tr class="text-right"
                                        v-if="(Invoice.discount || Invoice.advance_paid) && (Invoice.vat || Invoice.tax)">
                                        <th>Net Amount:</th>
                                        <td>{{'BDT '}}{{Invoice.net_amount.toFixed(2)}}</td>
                                    </tr>
                                    <tr class="text-right" v-if="Invoice.discount">
                                        <th class="border-0">Discount:</th>
                                        <td class="border-0">{{'BDT '}}{{Invoice.discount.toFixed(2)}}</td>
                                    </tr>
                                    <tr class="text-right" v-if="Invoice.advance_paid">
                                        <th class="border-0" v-if="Invoice.advance_paid">Advance Paid:</th>
                                        <td class="border-0">{{'BDT '}}{{Invoice.advance_paid.toFixed(2)}}</td>
                                    </tr>
                                    <tr class="text-right">
                                        <th>Payable:</th>
                                        <td>{{'BDT '}}{{(Invoice.net_amount-Invoice.discount-Invoice.advance_paid).toFixed(2)}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-left">
                        <a class="btn btn-danger" href="#">Cancel</a>
                        <a href="#" @click="printInvoice()"
                                class="btn btn-info">
                            <span class="fa fa-print"></span>
                        </a>
                        <a class="btn btn-success" href="#" @click="downloadInvoice()"><i class="fa fa-download"> </i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InvoiceShowComponent",
        props: ['Invoice'],
        created() {

        },
        methods: {
            printInvoice() {
                window.open(window.location.origin+'/invoices/' + this.Invoice.invoice_number + '/print', "_blank");
            },
            downloadInvoice(){
                window.location.href = window.location.origin+'/invoices/' + this.Invoice.invoice_number + '/download';
            }
        },
    }
</script>

<style scoped>

</style>
