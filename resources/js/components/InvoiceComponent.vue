<template>
    <div class="row justify-content-center ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ 'ADD New Driver'}}</h5>
                </div>

                <form method="post" action="" autocomplete="off">

                    <div class="card-body ">
                        <div class="row align-items-start">
                            <!--                        ROW 1: Date and Invoice Type-->

                            <div class="form-group col-lg-10">
                                <h6 class="h6">Invoice Type</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                           id="inlineRadio1"
                                           value="option1">
                                    <label class="text-white form-check-label pl-0" for="inlineRadio1">Monthly
                                        Basis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                           id="inlineRadio2"
                                           value="option2">
                                    <label class="text-white form-check-label pl-0" for="inlineRadio2">Daily
                                        Basis</label>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-auto text-right">
                                <input class="form-control form-control-sm rounded-0 bg-neutral text-dark text-left"
                                       type="date"
                                       v-model="myDate"
                                       name="date">
                            </div>

                            <!--                        Row 2 From and To-->

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'TO' }}</label>
                                <select class="custom-select custom-select-sm rounded-0 bg-neutral text-dark col-lg-8">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{"Add a client"}}</button>
                            </div>

                            <div class="form-group ml-auto col-lg-6">
                                <label class="col-lg-12">{{ 'From' }}</label>
                                <select class="custom-select rounded-0 custom-select-sm bg-neutral text-dark col-lg-8">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{'Add a Company'}}</button>
                            </div>

                            <!--                        Row 3 Driver and Car Info-->

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'DRIVER' }}</label>
                                <select class="custom-select custom-select-sm rounded-0 bg-neutral text-dark col-lg-8">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{"Add a Driver"}}</button>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'Car Name and Reg. No:'}}</label>
                                <div class="pl-0 col-lg-12">
                                    <input type="text" name="name"
                                           class="form-control rounded-0 form-control-sm bg-neutral text-dark"
                                           placeholder="Car Name and Reg. No:" value="">
                                </div>
                            </div>
                        </div>

                        <!--                        Row 4: Invoice Table-->

                        <table class="border-neutral table-responsive-xl table-bordered bg-default table pt-2">

                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th style="min-width: 350px !important;" scope="col">Description</th>
                                <th style="min-width: 70px !important;" scope="col">Quantity</th>
                                <th style="min-width: 100px !important;" scope="col">Unit</th>
                                <th style="min-width: 100px !important;" scope="col">Rate</th>
                                <th style="min-width: 150px !important;" scope="col">Amount</th>
                                <th style="min-width: 70px !important;" class="border-0" scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(item, index) in items">

                                <!--                                Index-->

                                <td>{{index+1}}</td>

                                <!--                                Description-->

                                <td>
                                    <input type="text" name="description" v-model="item.description"
                                           class="border bg-neutral text-dark rounded-0 form-control"
                                           placeholder="Enter Description" value="">
                                </td>

                                <!--                                Quantity-->

                                <td>
                                    <input @input="calculateAmount(index)" type="number" step="any"
                                           name="quantity" v-model="item.quantity"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Quantity">
                                </td>

                                <!--                                Unit-->

                                <td>
                                    <select name="unit" v-model="item.unit"
                                            class="custom-select text-dark bg-neutral border rounded-0">
                                        <option value="" selected>None</option>
                                        <option value="Year">Year</option>
                                        <option value="Month">Month</option>
                                        <option value="Day">Day</option>
                                        <option value="Night">Night</option>
                                        <option value="KM">KM</option>
                                        <option value="Piece">Pcs.</option>
                                    </select>
                                </td>

                                <!--                                Rate-->

                                <td>
                                    <input @input="calculateAmount(index)" v-model="item.rate"
                                           type="number" step="any" name="rate"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Rate">
                                </td>

                                <!--                                Amount-->

                                <td>
                                    <input type="number" step="any" name="amount"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Total" :value="item.amount" readonly>
                                </td>
                                <td class="text-center">

                                    <button v-if="index==0" type="button" @click.prevent="addRow()"
                                            class="rounded-0 btn p-2 pl-3 pr-3 btn-success">
                                        <i class="tim-icons icon-simple-add"></i>
                                    </button>
                                    <button v-else type="button" @click.prevent="removeRow(index)"
                                            class="rounded-0 btn p-2 pl-3 pr-3 btn-danger">
                                        <i class="tim-icons icon-simple-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            </tbody>

                            <!--                            Table Foot-->

                            <tfoot>

                            <!--                            Sub-Total & VAT, TAX Check Box-->

                            <tr>
                                <td colspan="2">
                                    <div class="input-group  justify-content-center mb-0">
                                        <div class="input-group-text border-success rounded-0 mr-2">
                                            <label class="form-check-label text-white">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="form.taxChkBox">
                                                + TAX</label>
                                        </div>
                                        <div class="input-group-text border-success rounded-0 mr-2">
                                            <label class="form-check-label text-white">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="form.vatChkBox">
                                                + VAT</label>
                                        </div>
                                        <div class="input-group-text border-success rounded-0 mr-2">
                                            <label class="form-check-label text-white">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="form.discountChkBox">
                                                Discount</label>
                                        </div>
                                        <div class="input-group-text border-success rounded-0">
                                            <label class="form-check-label text-white">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="form.paidChkBox">
                                                Paid</label>
                                        </div>
                                    </div>
                                </td>

                                <!--                                Sub-Total-->

                                <td class="text-right" colspan="2">{{"Sub-Total:"}}</td>
                                <td colspan="3">
                                    <input type="number" step="any" name="sub-total"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Sub-Total" :value="form.subTotal" readonly>
                                </td>
                            </tr>

                            <!--                            VAT, TAX & Discount-->

                            <tr v-if="form.taxChkBox">
                                <td class="text-right" colspan="3">+TAX</td>
                                <td>
                                    <div class="d-flex" style="max-width: 100px !important;">
                                        <input type="number" step="any" name="taxIn" @input="calculateTax()"
                                               v-model="form.taxIn"
                                               class="border text-center text-dark bg-neutral text-dark rounded-0 form-control">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-neutral border text-dark rounded-0">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <input type="number" step="any" :value="form.taxOut"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="TAX" readonly>
                                </td>
                            </tr>
                            <tr v-if="form.vatChkBox">
                                <td class="text-right" colspan="3">(Total+TAX)+VAT</td>
                                <td>
                                    <div class="d-flex" style="max-width: 100px !important;">
                                        <input type="number" name="vatIn" step="any" @input="calculateVat()"
                                               v-model="form.vatIn"
                                               class="border text-center text-dark bg-neutral text-dark rounded-0 form-control">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-neutral border text-dark rounded-0">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <input type="number" step="any" :value="form.vatOut"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="VAT" readonly>
                                </td>
                            </tr>

                            <!--                            Net Amount-->

                            <tr>
                                <td class="text-right" colspan="4">Net Amount:</td>
                                <td colspan="3">
                                    <input type="number" step="any" name="total"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Net Amount" v-model="form.netAmount" readonly>
                                </td>
                            </tr>

                            <!--                            Discount-->

                            <tr v-if="form.discountChkBox">
                                <td class="text-right" colspan="4">Discount:</td>
                                <td colspan="3">
                                    <input type="number" step="any" name="discount" @input="calculatePayable()"
                                           v-model="form.discount"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Discount">
                                </td>
                            </tr>

                            <!--                            Paid-->

                            <tr v-if="form.paidChkBox">
                                <td class="text-right" colspan="4">Advance Paid:</td>
                                <td colspan="3">
                                    <input type="number" step="any" name="paid" @input="calculatePayable()" v-model="form.paid"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Paid Amount">
                                </td>
                            </tr>

                            <!--                            Payable-->

                            <tr v-if="form.discountChkBox || form.paidChkBox">
                                <td class="text-right" colspan="4">Payable:</td>
                                <td colspan="3">
                                    <input type="number" step="any" name="payable" :value="form.payable"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Payable" readonly>
                                </td>
                            </tr>

                            </tfoot>

                        </table>
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
        mounted() {

        },
        data() {
            return {
                myDate: new Date().toISOString().slice(0, 10),
                items: [
                    {

                        description: '',
                        quantity: null,
                        unit: '',
                        rate: null,
                        amount: 0,
                    }
                ],
                form: {
                    vatChkBox: false,
                    taxChkBox: false,
                    paidChkBox: false,
                    discountChkBox: false,
                    subTotal: 0,
                    vatIn: 0,
                    vatOut: 0,
                    taxIn: 0,
                    taxOut: 0,
                    netAmount: 0,
                    discount: 0,
                    paid: 0,
                    payable: 0,
                },
            }
        },
        watch: {},
        methods: {
            addRow() {
                this.items.push(
                    {
                        description: '',
                        quantity: null,
                        unit: '',
                        rate: null,
                        amount: 0,
                    }
                );
            },

            removeRow(index) {
                this.items.splice(index, 1);
                this.calculateSubtotal();
            },

            calculateAmount(index) {
                this.items[index].amount = (this.items[index].quantity ? this.items[index].quantity : 1) * this.items[index].rate;
                this.calculateSubtotal();
            },

            calculateSubtotal() {
                this.form.subTotal = 0;
                this.items.forEach((vale, index) => {
                    this.form.subTotal += vale.amount;
                });

                // Calling Based on Check Box

                if (this.form.taxChkBox) {
                    this.calculateTax();
                    this.calculatePayable();
                }
                if (this.form.vatChkBox) {
                    this.calculateVat();
                }
                this.calculateNetAmount();
            },
            calculateTax() {
                this.form.taxOut = this.form.taxIn * (1 / 100) * this.form.subTotal;
                this.calculateNetAmount();
            },
            calculateVat() {
                this.form.vatOut = this.form.vatIn * (1 / 100) * this.form.subTotal;
                this.calculateNetAmount();
            },
            calculateNetAmount() {
                this.form.netAmount = (this.form.taxChkBox ? this.form.taxOut : 0) + (this.form.vatChkBox ? this.form.vatOut : 0) + this.form.subTotal;
                if (this.form.discountChkBox||this.form.paidChkBox){
                    this.calculatePayable();
                }
            },

            calculatePayable() {
                this.form.payable = this.form.netAmount - (this.form.discountChkBox ? this.form.discount : 0) - (this.form.paidChkBox ? this.form.paid : 0);
            }

        },
        computed: {}
    }
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
