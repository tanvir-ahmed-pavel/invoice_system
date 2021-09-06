<template>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow bg-lighter">
                    <form method="post" @submit.prevent="submit()" autocomplete="off">

                        <div class="card-body ">
                            <div class="row align-items-center justify-content-end">

                                <!--                        ROW 1: Date and Invoice Type-->

                                <div class="form-group col-lg-9">
                                    <h6 class="h6">Invoice Type <span class="text-danger">*</span></h6>
                                    <validation-error :errors="errors.invoice_type"></validation-error>

                                    <div class="btn-group-toggle">
                                        <label class="rounded-0 btn btn-sm btn-outline-primary"
                                               :class="(form.invoice_type=='Monthly')? 'active': ''">
                                            <input class="form-check-input" type="radio" v-model="form.invoice_type"
                                                   value="Monthly">
                                            Monthly Basis
                                        </label>
                                        <label class="rounded-0 btn btn-sm btn-outline-primary"
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

                                    <input class=" form-control form-control-sm rounded-0 text-center text-dark"
                                           type="date"
                                           v-model="form.date">
                                </div>

                                <!--                        Row 2 From and To-->

                                <div class="form-group col-lg-6">
                                    <label class="col-lg-12">{{ 'TO' }} <span class="text-danger">*</span></label>
                                    <div>
                                        <validation-error class="col-lg-6" :errors="errors.to"></validation-error>
                                    </div>

                                    <select v-model="form.client_id"
                                            class="custom-select custom-select-sm rounded-0 text-dark col-lg-8">
                                        <option value="">None</option>
                                        <option v-for="(client, index) in Clients" :value="client.id">
                                            {{client.client_name}}
                                        </option>
                                    </select>
                                    <button class="rounded-0 btn btn-sm btn-primary">{{"Add a client"}}
                                    </button>
                                </div>

                                <div class="form-group ml-auto col-lg-6">
                                    <label class="col-lg-12">{{ 'From' }} <span class="text-danger">*</span></label>
                                    <div>
                                        <validation-error class="col-lg-12" :errors="errors.from"></validation-error>
                                    </div>


                                    <select v-model="form.company_id"
                                            class="custom-select rounded-0 custom-select-sm text-dark col-lg-8">
                                        <option value="">None</option>
                                        <option v-for="(company, index) in Companies" :value="company.id">
                                            {{company.company_name}}
                                        </option>
                                    </select>
                                    <button class="rounded-0 btn btn-sm btn-primary">{{'Add a Company'}}
                                    </button>
                                </div>

                                <!--                        Row 3 Driver and Car Info-->

                                <div class="form-group col-lg-6">
                                    <label class="col-lg-12">{{ 'DRIVER' }} <span class="text-danger">*</span></label>
                                    <validation-error class="col-lg-12" :errors="errors.driver_id"></validation-error>

                                    <select v-model="form.driver_id"
                                            class="custom-select custom-select-sm rounded-0 text-dark col-lg-8">
                                        <option value="">None</option>
                                        <option v-for="(driver, index) in Drivers" :value="driver.id">{{driver.name + ' -- ' + driver.contact}}
                                        </option>
                                    </select>
                                    <button class="rounded-0 btn btn-sm btn-primary">{{"Add a Driver"}}
                                    </button>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-lg-12">{{ 'Car Name and Reg. No:'}} <span
                                        class="text-danger">*</span></label>

                                    <validation-error class="col-lg-12" :errors="errors.car_details"></validation-error>
                                    <div class="pl-0 col-lg-12">
                                        <input type="text"
                                               class="form-control rounded-0 form-control-sm text-dark"
                                               placeholder="Car Name and Reg. No:" v-model="form.car_details">
                                    </div>
                                </div>
                            </div>

                            <!--                        Row 4: Items Table-->


                            <table class="table-responsive-xl table-bordered table pt-2">

                                <thead>
                                <tr>
                                    <th scope="col" class="p-1">#</th>
                                    <th class="p-1" style="min-width: 350px !important;" scope="col">Description <span
                                        class="text-danger">*</span></th>
                                    <th class="p-1" style="min-width: 70px !important;" scope="col">Quantity</th>
                                    <th class="p-1" style="min-width: 100px !important;" scope="col">Unit</th>
                                    <th class="p-1" style="min-width: 100px !important;" scope="col">Rate <span
                                        class="text-danger">*</span></th>
                                    <th class="p-1" style="min-width: 150px !important;" scope="col">Amount</th>
                                    <th class="p-1" style="min-width: 70px !important;" scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr v-for="(item, index) in form.items">

                                    <!--                                Index-->

                                    <td class="p-1">{{index+1}}</td>

                                    <!--                                Description-->

                                    <td class="p-1">
<!--                                        <span class="text-danger" v-if="errors[`items.${index}.description`]">*This is a required filed</span>-->
                                        <input type="text" v-model="item.description"
                                               class="text-dark rounded-0 form-control form-control-sm"
                                               :class="(errors[`items.${index}.description`])?'is-invalid custom-placeholder':''"
                                               :placeholder="(errors[`items.${index}.description`])? '*This is a required filed': 'Enter Description'">

                                        <!--                                    <validation-error :errors="errors['items.'+[index]+'.description']"></validation-error>-->
                                    </td>

                                    <!--                                Quantity-->

                                    <td class="p-1">
                                        <input @input="calculateAmount(index)" type="number" step=".01"
                                               v-model="item.quantity"
                                               class="border text-dark rounded-0 form-control form-control-sm"
                                               placeholder="Quantity">
                                        <!--                                    <validation-error :errors="errors['items.'+[index]+'.quantity']"></validation-error>-->
                                    </td>

                                    <!--                                Unit-->

                                    <td class="p-1">
                                        <select v-model="item.unit"
                                                class="custom-select custom-select-sm text-dark border rounded-0">
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

                                    <td class="p-1">
                                        <input @input="calculateAmount(index)" v-model="item.rate"
                                               type="number" step=".01"
                                               class="text-dark rounded-0 form-control form-control-sm" :class="(errors[`items.${index}.rate`])?'is-invalid custom-placeholder':''"
                                               :placeholder="(errors[`items.${index}.rate`])? '*This is a required filed': 'Enter Rate'">
                                        <!--                                    <validation-error :errors="errors['items.'+[index]+'.rate']"></validation-error>-->
                                    </td>

                                    <!--                                Amount-->

                                    <td class="p-1">
                                        <input type="number" step=".01"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="Total" :value="item.amount.toFixed(2)" readonly>
                                        <!--                                    <validation-error :errors="errors['items.'+[index]+'.amount']"></validation-error>-->
                                    </td>

                                    <td class="text-center p-1">

                                        <button v-if="index==0" type="button" @click.prevent="addRow()"
                                                class="rounded-0 btn pl-2 pr-2 btn-primary btn-sm">
                                            <i class="ni ni-fat-add"></i>
                                        </button>
                                        <button v-else type="button" @click="removeRow(index)"
                                                class="rounded-0 btn pl-2 pr-2 btn-danger btn-sm">
                                            <i class="ni ni-fat-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                                </tbody>

                                <!--                            Table Foot-->

                                <tfoot>

                                <!--                            Sub-Total & VAT, TAX Check Box-->

                                <tr>
                                    <td class="p-1" colspan="2">
                                        <div class="btn-group-toggle text-center">
                                            <label :class="(taxChkBox)? 'active ': ''"
                                                   class="rounded-0 btn btn-sm btn-outline-primary">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="taxChkBox">
                                                + TAX
                                            </label>
                                            <label :class="(vatChkBox)? 'active ': ''"
                                                   class="rounded-0 btn btn-sm btn-outline-primary">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="vatChkBox">
                                                + VAT
                                            </label>
                                            <label :class="(discountChkBox)? 'active ': ''"
                                                   class="rounded-0 btn btn-sm btn-outline-primary">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="discountChkBox">
                                                Discount
                                            </label>
                                            <label :class="(paidChkBox)? 'active ': ''"
                                                   class="rounded-0 btn btn-sm btn-outline-primary">
                                                <input type="checkbox" @change="calculateNetAmount()"
                                                       v-model="paidChkBox">
                                                Paid
                                            </label>
                                        </div>
                                    </td>

                                    <!--                                Sub-Total-->

                                    <td class="text-right p-1 pt-2" colspan="2">{{"Sub-Total:"}}</td>
                                    <td colspan="3" class="p-1">
                                        <input type="number" step=".01"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="Sub-Total" :value="form.sub_total.toFixed(2)" readonly>
                                    </td>
                                </tr>

                                <!--                            VAT, TAX & Discount-->

                                <tr v-if="taxChkBox">
                                    <td class="text-right p-1 pt-2" colspan="3">+TAX</td>
                                    <td class="p-1">
                                        <div class="d-flex" style="max-width: 100px !important;">
                                            <input type="number" step=".01" @input="calculateTax()"
                                                   v-model="form.tax"
                                                   class="border text-center text-dark text-dark rounded-0 form-control form-control-sm">
                                            <div class="input-group-prepend input-group-sm">
                                            <span
                                                class="pl-2 pr-2 pt-1  border text-dark rounded-0">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01" :value="taxOut.toFixed(2)"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="TAX" readonly>
                                    </td>
                                </tr>
                                <tr v-if="vatChkBox">
                                    <td class="text-right p-1 pt-2" colspan="3">+VAT</td>
                                    <td class="p-1">
                                        <div class="d-flex" style="max-width: 100px !important;">
                                            <input type="number" step=".01" @input="calculateVat()"
                                                   v-model="form.vat"
                                                   class="border text-center text-dark text-dark rounded-0 form-control form-control-sm">
                                            <div class="input-group-prepend input-group-sm">
                                            <span
                                                class="pl-2 pr-2 pt-1 border text-dark rounded-0">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01" :value="vatOut.toFixed(2)"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="VAT" readonly>
                                    </td>
                                </tr>

                                <!--                            Net Amount-->

                                <tr>
                                    <td class="text-right p-1  pt-2" colspan="4">Net Amount:</td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="Net Amount" :value="form.net_amount.toFixed(2)" readonly>
                                    </td>
                                </tr>

                                <!--                            Discount-->

                                <tr v-if="discountChkBox">
                                    <td class="text-right p-1  pt-2" colspan="4">Discount:</td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01" @input="calculatePayable()"
                                               v-model="form.discount"
                                               class="border text-dark rounded-0 form-control form-control-sm"
                                               placeholder="Discount">
                                    </td>
                                </tr>

                                <!--                            Paid-->

                                <tr v-if="paidChkBox">
                                    <td class="text-right p-1  pt-2" colspan="4">Advance Paid:</td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01" @input="calculatePayable()"
                                               v-model="form.advance_paid"
                                               class="border text-dark rounded-0 form-control form-control-sm"
                                               placeholder="Paid Amount">
                                    </td>
                                </tr>

                                <!--                            Payable-->

                                <tr v-if="discountChkBox || paidChkBox">
                                    <td class="text-right pt-2 p-1" colspan="4">Payable:</td>
                                    <td class="p-1" colspan="3">
                                        <input type="number" step=".01" :value="payable.toFixed(2)"
                                               class="border text-dark bg-success rounded-0 form-control form-control-sm"
                                               placeholder="Payable" readonly>
                                    </td>
                                </tr>

                                </tfoot>

                            </table>

                            <div class="text-center pt-4">
                                <button type="submit" class="btn btn-fill btn-primary rounded-0">
                                    {{'Save'}}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
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
        },
        props: ['Drivers', 'Companies', 'Clients'],
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
                    client_id: '',
                    company_id: '',
                    driver_id: '',
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

                this.axios.post("/invoices", this.form).then((res) => {
                    // console.log(res.data);
                    window.location.href = '/invoices/' + res.data;
                }).catch((e) => {
                    this.errors = e.response.data.errors;
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

    .custom-placeholder::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: red;
        opacity: 1; /* Firefox */
    }


    .custom-placeholder:-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: red;
    }

    .custom-placeholder::-ms-input-placeholder { /* Microsoft Edge */
        color: red;
    }

</style>
