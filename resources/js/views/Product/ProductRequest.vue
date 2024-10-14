<template>

    <div>

        <div class="page-heading">
            <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{('New Product Request') }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link to="/dashboard">{{ __('dashboard') }}</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ('Product Request') }}</li>
                    </ol>
                </nav>
            </div>
        </div>

            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{('Product Request') }}</h4>
                            <span class="pull-right">
                              </span>
                        </div>

                        <div class="card-body">
                            <b-row class="mb-2">
                                <b-col md="3" offset-md="8">
                                    <h6 class="box-title">{{ __('search') }}</h6>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="filter"
                                        type="search"
                                        :placeholder="__('search')"
                                    ></b-form-input>
                                </b-col>
                                <b-col md="1" class="text-center">
                                    <button class="btn btn-primary btn_refresh" v-b-tooltip.hover :title="__('refresh')" @click="getRecords()">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </button>
                                </b-col>
                            </b-row>
                            <b-table
                                :items="brands"
                                :fields="fields"
                                :current-page="currentPage"
                                :per-page="perPage"
                                :filter="filter"
                                :filter-included-fields="filterOn"
                                :sort-by.sync="sortBy"
                                :sort-desc.sync="sortDesc"
                                :sort-direction="sortDirection"
                                :bordered="true"
                                :busy="isLoading"
                                stacked="md"
                                show-empty
                                small>
                                <template #table-busy>
                                    <div class="text-center text-black my-2">
                                        <b-spinner class="align-middle"></b-spinner>
                                        <strong>{{ __('loading') }}...</strong>
                                    </div>
                                </template>

                                <template #cell(id)="row">
                                    {{ row.item.id }}
                                </template>

                                <template #cell(userId)="row">
                                    {{ row.item.user_id }}
                                </template>

                                <template #cell(prodName)="row">
                                    {{ row.item.product_name }}
                                </template>

                                <template #cell(image)="row">
                                    <p v-if="row.item.product_image ===''">{{ __('no_image') }}</p>
                                    <button  @click="previewImg(row.item.product_image, row.item.user) "  class="col-md-4" v-else> <img  :src=" row.item.product_image" height="50"  />
                                    </button>
                                    
                                </template>
                                <template #cell(category)="row">
                                    {{ row.item.product_catagory }}
                                </template>
                                <template #cell(description)="row">
                                    {{ row.item.product_discription }}
                                </template>
                                <template #cell(created_at)="row">
                                    {{ new Date(row.item.created_at).toLocaleString() }}
                                </template>
                              </b-table>
                            <b-row>
                                <b-col  md="2" class="my-1">
                                    <b-form-group
                                        :label="__('per_page')"
                                        label-for="per-page-select"
                                        label-align-sm="right"
                                        label-size="sm"
                                        class="mb-0">
                                        <b-form-select
                                            id="per-page-select"
                                            v-model="perPage"
                                            :options="pageOptions"
                                            size="sm"
                                            class="form-control form-select"
                                        ></b-form-select>
                                    </b-form-group>
                                </b-col>
                                <b-col  md="4" class="my-1" offset-md="6">
                                    <label>Total Records :- {{ totalRows }} </label>
                                    <b-pagination
                                        v-model="currentPage"
                                        :total-rows="totalRows"
                                        :per-page="perPage"
                                        align="fill"
                                        size="sm"
                                        class="my-0"
                                    ></b-pagination>
                                </b-col>
                            </b-row>

                        </div>
                    </div>
                </div>
            </div>
        </div>

            <b-modal v-model="edit_record"  title="Product Info">
             <app-edit-record
                :image="previewImage"
                :user="user"
            ></app-edit-record> 
        </b-modal>
    </div>

</template>
<script>
import { VuejsDatatableFactory } from 'vuejs-datatable';
import EditRecord from './EditProductRequest.vue';


export default {
    components: {
            VuejsDatatableFactory,
            'app-edit-record' : EditRecord,
    },
    data: function() {
        return {
            fields: [
                { key: 'id', label: __('id'), class: 'text-center', sortable: true, sortDirection: 'desc' },
                { key:'userId', label:__('user_id'),class:'text-center'},
                { key: 'prodName', label: __('product_name'),  class: 'text-center' },
                { key: 'image', label: __('product_image'),  class: 'text-center' },
                { key:'category', label:__('product_catagory'),class:'text-center'},
                { key:'description', label:__('product_discription'),class:'text-center'},
                { key:'created_at', label:__('created_at'),class:'text-center'},
            ],
            totalRows: 1,
            currentPage: 1,
            previewImage:'',
            user:'',
            perPage: this.$perPage,
            pageOptions: this.$pageOptions,
            sortBy: '',
            sortDesc: false,
            sortDirection: 'asc',
            filter: null,
            filterOn: [],
            page: 1,
            isLoading: false,
            sectionStyle : 'style_1',
            max_visible_units : 12,
            max_col_in_single_row : 3,
            brands: [],
            create_new : null,
            edit_record : false,
        }
    },
    created: function() {
        this.$eventBus.$on('recordSaved', (message) => {
            this.showMessage('success', message);
            // this.getRecords();

        });
        // this.getRecords();
        this.getData();
        console.log("brand page")
    },
    methods: {

        // getRecords(){
        //     this.isLoading = true
        //     axios.get(this.$apiUrl + '/products/brands')
        //         .then((response) => {
        //             console.log(response);
        //             this.isLoading = false
        //             let data = response.data;
        //             this.brands = data.data
        //         });
        // },
        previewImg(image,user){
            console.log("user",user);
            this.edit_record = true;
            this.previewImage=image;
            this.user=user;
        },
        getData(){
            this.isLoading = true
            axios.get(this.$apiUrl + '/requested-products')
                .then((response) => {
                    console.log("565")
                    this.isLoading = false;
                    let data = response.data.data.data;
                    this.brands = data; 
                    console.log("res",data);
                });
        },
    },
 
};
</script>
