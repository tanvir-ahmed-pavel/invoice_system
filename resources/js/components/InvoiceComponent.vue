<template>
    <div class="row justify-content-center ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ 'ADD New Driver'}}</h5>
                </div>

                <form method="post" @submit.prevent="submit()"  autocomplete="off">

                    <div class="card-body ">
                        <div class="row align-items-center justify-content-end">
                            <!--                        ROW 1: Date and Invoice Type-->

                            <div class="form-group col-lg-9">
                                <h6 class="h6">Invoice Type <span class="text-danger">*</span></h6>
                                <validation-error :errors="errors.invoice_type"></validation-error>

                                <div class="btn-group-toggle">
                                    <label class="rounded-0 btn btn-sm btn-success btn-simple"
                                           :class="(form.invoice_type=='Monthly')? 'active': ''">
                                        <input class="form-check-input" type="radio" v-model="form.invoice_type"
                                               value="Monthly">
                                        Monthly Basis
                                    </label>
                                    <label class="rounded-0 btn btn-sm btn-success btn-simple"
                                           :class="(form.invoice_type=='Daily')? 'active': ''">
                                        <input class="form-check-input" type="radio" v-model="form.invoice_type"
                                               value="Daily">
                                        Daily Basis
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-lg-3">
                                <h6 class="h6">Date <span class="text-danger">*</span></h6>
                                <validation-error :errors="errors.date"></validation-error>

                                <input class=" form-control form-control-sm rounded-0 bg-neutral text-center text-dark"
                                       type="date"
                                       v-model="form.date">
                            </div>

                            <!--                        Row 2 From and To-->

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'TO' }} <span class="text-danger">*</span></label>
                                <div>
                                    <validation-error class="col-lg-6" :errors="errors.to"></validation-error>
                                </div>

                                <select v-model="form.client_id" class="custom-select custom-select-sm rounded-0 bg-neutral text-dark col-lg-8">

                                    <option selected value="" disabled>Select....</option>
                                    <option value="">None</option>
                                    <option v-for="(client, index) in Clients" :value="client.id">{{client.client_name}}</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{"Add a client"}}</button>
                            </div>

                            <div class="form-group ml-auto col-lg-6">
                                <label class="col-lg-12">{{ 'From' }} <span class="text-danger">*</span></label>
                                <div>
                                    <validation-error class="col-lg-12" :errors="errors.from"></validation-error>
                                </div>


                                <select v-model="form.company_id" class="custom-select rounded-0 custom-select-sm bg-neutral text-dark col-lg-8">
                                    <option selected value="" disabled>Select...</option>
                                    <option value="">None</option>
                                    <option v-for="(company, index) in Companies" :value="company.id">{{company.company_name}}</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{'Add a Company'}}</button>
                            </div>

                            <!--                        Row 3 Driver and Car Info-->

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'DRIVER' }} <span class="text-danger">*</span></label>
                                <validation-error class="col-lg-12" :errors="errors.driver_id"></validation-error>

                                <select v-model="form.driver_id" class="custom-select custom-select-sm rounded-0 bg-neutral text-dark col-lg-8">
                                    <option selected value="" disabled>Select...</option>
                                    <option value="">None</option>
                                    <option v-for="(driver, index) in Drivers" :value="driver.id">{{driver.name}}</option>
                                </select>
                                <button class="rounded-0 btn btn-sm btn-success btn-simple">{{"Add a Driver"}}</button>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="col-lg-12">{{ 'Car Name and Reg. No:'}} <span class="text-danger">*</span></label>

                                <validation-error class="col-lg-12" :errors="errors.car_details"></validation-error>
                                <div class="pl-0 col-lg-12">
                                    <input type="text"
                                           class="form-control rounded-0 form-control-sm bg-neutral text-dark"
                                           placeholder="Car Name and Reg. No:" v-model="form.car_details">
                                </div>
                            </div>
                        </div>

                        <!--                        Row 4: Invoice Table-->

                        <table class="border-neutral table-responsive-xl table-bordered bg-default table pt-2">

                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th style="min-width: 350px !important;" scope="col">Description <span
                                    class="text-danger">*</span></th>
                                <th style="min-width: 70px !important;" scope="col">Quantity</th>
                                <th style="min-width: 100px !important;" scope="col">Unit</th>
                                <th style="min-width: 100px !important;" scope="col">Rate <span
                                    class="text-danger">*</span></th>
                                <th style="min-width: 150px !important;" scope="col">Amount</th>
                                <th style="min-width: 70px !important;" class="border-0" scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(item, index) in form.items">

                                <!--                                Index-->

                                <td>{{index+1}}</td>

                                <!--                                Description-->

                                <td>
                                    <input type="text" v-model="item.description"
                                           class="border bg-neutral text-dark rounded-0 form-control"
                                           placeholder="Enter Description">

<!--                                    <validation-error :errors="errors['items.'+[index]+'.description']"></validation-error>-->
                                </td>

                                <!--                                Quantity-->

                                <td>
                                    <input @input="calculateAmount(index)" type="number" step="any"
                                           v-model="item.quantity"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Quantity">
<!--                                    <validation-error :errors="errors['items.'+[index]+'.quantity']"></validation-error>-->
                                </td>

                                <!--                                Unit-->

                                <td>
                                    <select v-model="item.unit"
                                            class="custom-select text-dark bg-neutral border rounded-0">
                                        <option value="" selected>None</option>
                                        <option value="Year">Year</option>
                                        <option value="Month">Month</option>
                                        <option value="Day">Day</option>
                                        <option value="Night">Night</option>
                                        <option value="KM">KM</option>
                                        <option value="Piece">Pcs.</option>
                                    </select>
<!--                                    <validation-error :errors="errors['items.'+[index]+'.unit']"></validation-error>-->
                                </td>

                                <!--                                Rate-->

                                <td>
                                    <input @input="calculateAmount(index)" v-model="item.rate"
                                           type="number" step="any"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Rate">
<!--                                    <validation-error :errors="errors['items.'+[index]+'.rate']"></validation-error>-->
                                </td>

                                <!--                                Amount-->

                                <td>
                                    <input type="number" step="any"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Total" :value="item.amount" readonly>
<!--                                    <validation-error :errors="errors['items.'+[index]+'.amount']"></validation-error>-->
                                </td>

                                <td class="text-center">

                                    <button v-if="index==0" type="button" @click.prevent="addRow()"
                                            class="rounded-0 btn p-2 pl-3 pr-3 btn-success">
                                        <i class="tim-icons icon-simple-add"></i>
                                    </button>
                                    <button v-else type="button" @click="removeRow(index)"
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
                                    <div class="btn-group-toggle text-center">
                                        <label :class="(taxChkBox)? 'active ': ''"
                                               class="rounded-0 btn btn-sm btn-success btn-simple">
                                            <input type="checkbox" @change="calculateNetAmount()"
                                                   v-model="taxChkBox">
                                            + TAX
                                        </label>
                                        <label :class="(vatChkBox)? 'active ': ''"
                                               class="rounded-0 btn btn-sm btn-success btn-simple">
                                            <input type="checkbox" @change="calculateNetAmount()"
                                                   v-model="vatChkBox">
                                            + VAT
                                        </label>
                                        <label :class="(discountChkBox)? 'active ': ''"
                                               class="rounded-0 btn btn-sm btn-success btn-simple">
                                            <input type="checkbox" @change="calculateNetAmount()"
                                                   v-model="discountChkBox">
                                            Discount
                                        </label>
                                        <label :class="(paidChkBox)? 'active ': ''"
                                               class="rounded-0 btn btn-sm btn-success btn-simple">
                                            <input type="checkbox" @change="calculateNetAmount()"
                                                   v-model="paidChkBox">
                                            Paid
                                        </label>
                                    </div>
                                </td>

                                <!--                                Sub-Total-->

                                <td class="text-right" colspan="2">{{"Sub-Total:"}}</td>
                                <td colspan="3">
                                    <input type="number" step="any"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Sub-Total" :value="form.sub_total" readonly>
                                </td>
                            </tr>

                            <!--                            VAT, TAX & Discount-->

                            <tr v-if="taxChkBox">
                                <td class="text-right" colspan="3">+TAX</td>
                                <td>
                                    <div class="d-flex" style="max-width: 100px !important;">
                                        <input type="number" step="any" @input="calculateTax()"
                                               v-model="form.tax"
                                               class="border text-center text-dark bg-neutral text-dark rounded-0 form-control">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-neutral border text-dark rounded-0">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <input type="number" step="any" :value="taxOut"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="TAX" readonly>
                                </td>
                            </tr>
                            <tr v-if="vatChkBox">
                                <td class="text-right" colspan="3">(Total+TAX)+VAT</td>
                                <td>
                                    <div class="d-flex" style="max-width: 100px !important;">
                                        <input type="number" step="any" @input="calculateVat()"
                                               v-model="form.vat"
                                               class="border text-center text-dark bg-neutral text-dark rounded-0 form-control">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text bg-neutral border text-dark rounded-0">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <input type="number" step="any" :value="vatOut"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="VAT" readonly>
                                </td>
                            </tr>

                            <!--                            Net Amount-->

                            <tr>
                                <td class="text-right" colspan="4">Net Amount:</td>
                                <td colspan="3">
                                    <input type="number" step="any"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Net Amount" v-model="form.net_amount" readonly>
                                </td>
                            </tr>

                            <!--                            Discount-->

                            <tr v-if="discountChkBox">
                                <td class="text-right" colspan="4">Discount:</td>
                                <td colspan="3">
                                    <input type="number" step="any" @input="calculatePayable()"
                                           v-model="form.discount"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Discount">
                                </td>
                            </tr>

                            <!--                            Paid-->

                            <tr v-if="paidChkBox">
                                <td class="text-right" colspan="4">Advance Paid:</td>
                                <td colspan="3">
                                    <input type="number" step="any" @input="calculatePayable()"
                                           v-model="form.advance_paid"
                                           class="border text-dark bg-neutral rounded-0 form-control"
                                           placeholder="Paid Amount">
                                </td>
                            </tr>

                            <!--                            Payable-->

                            <tr v-if="discountChkBox || paidChkBox">
                                <td class="text-right" colspan="4">Payable:</td>
                                <td colspan="3">
                                    <input type="number" step="any" :value="payable"
                                           class="border text-dark bg-success rounded-0 form-control"
                                           placeholder="Payable" readonly>
                                </td>
                            </tr>

                            </tfoot>

                        </table>

                    </div>
                    <div class="card-footer text-center">
                        <button type="submit"  class="btn btn-fill btn-success rounded-0">
                            {{'Save'}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import ValidationError from "./validation-error";
    export default {
        name: "InvoiceComponent",
        components: {ValidationError},
        mounted() {
            console.log(this.Drivers);
        },
        props:['Drivers', 'Companies', 'Clients'],
        data() {
            return {
                form: {
                    date: new Date().toISOString().slice(0, 10),
                    sub_total: 0,
                    vat: 0,
                    tax: 0,
                    net_amount: 0,
                    discount: 0,
                    advance_paid: 0,
                    invoice_type: null,
                    car_details: null,
                    client_id:null,
                    company_id:null,
                    driver_id:null,
                    items: [
                        {
                            description: null,
                            quantity: null,
                            unit: '',
                            rate: null,
                            amount: 0,
                        },
                    ],
                },
                payable: 0,
                vatChkBox: false,
                vatOut: 0,
                taxChkBox: false,
                taxOut: 0,
                paidChkBox: false,
                discountChkBox: false,
                errors: [],
            }
        },
        watch: {},
        methods: {

            submit() {

                    this.axios.post("/invoices", this.form).then((res)=>{
                        console.log(res);
                    }).catch((e)=>{
                        this.errors=e.response.data.errors;
                    })
            },


            // Adds New Row

            addRow() {
                this.form.items.push(
                    {
                        description: null,
                        quantity: null,
                        unit: '',
                        rate: null,
                        amount: 0,
                    }
                );
            },

            // Removes Row

            removeRow(index) {
                this.form.items.splice(index, 1);
                this.calculateSubtotal();
            },

            calculateAmount(index) {
                this.form.items[index].amount = (this.form.items[index].quantity ? this.form.items[index].quantity : 1) * this.form.items[index].rate;
                this.calculateSubtotal();
            },

            calculateSubtotal() {
                this.form.sub_total = 0;
                this.form.items.forEach((value, index) => {
                    this.form.sub_total += value.amount;
                });

                // Calling Based on Check Box

                if (this.taxChkBox) {
                    this.calculateTax();
                    this.calculatePayable();
                }
                if (this.vatChkBox) {
                    this.calculateVat();
                    this.calculatePayable();
                }
                this.calculateNetAmount();
            },

            calculateTax() {
                this.taxOut = this.form.tax * (1 / 100) * this.form.sub_total;
                this.calculateNetAmount();
            },

            calculateVat() {
                this.vatOut = this.form.vat * (1 / 100) * this.form.sub_total;
                this.calculateNetAmount();
            },
            calculateNetAmount() {
                this.form.net_amount = (this.taxChkBox ? this.taxOut : 0) + (this.vatChkBox ? this.vatOut : 0) + this.form.sub_total;
                if (this.discountChkBox || this.paidChkBox) {
                    this.calculatePayable();
                }
            },

            calculatePayable() {
                this.payable = this.form.net_amount - (this.discountChkBox ? this.form.discount : 0) - (this.paidChkBox ? this.form.advance_paid : 0);
            }

        },
    }
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
