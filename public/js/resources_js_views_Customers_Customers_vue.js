"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_Customers_Customers_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['b2bCustomerInfoByID', 'b2bCustomerID'],
  mounted: function mounted() {},
  methods: {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _B2bCustomerInfoPopup_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./B2bCustomerInfoPopup.vue */ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    'b2b-customer-info-popup': _B2bCustomerInfoPopup_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      isLoading: false,
      fields: [{
        key: 'id',
        label: 'ID',
        sortable: true,
        sortDirection: 'desc'
      }, {
        key: 'name',
        label: 'Name',
        sortable: true,
        "class": 'text-center'
      }, {
        key: 'email',
        label: 'Email',
        sortable: true,
        "class": 'text-center'
      }, {
        key: 'mobile',
        label: 'M.No',
        sortable: true,
        "class": 'text-center'
      },
      /*{ key: 'balance', label: 'Balance', sortable: true, class: 'text-center' },
      { key: 'friends_code', label: 'Friends code', sortable: true, class: 'text-center' },
      { key: 'city', label: 'City', sortable: true, class: 'text-center' },
      { key: 'pincode', label: 'Pincode', sortable: true, class: 'text-center' },*/
      {
        key: 'status',
        label: 'Status',
        sortable: true,
        "class": 'text-center'
      }, {
        key: 'created_at',
        label: 'Date & Time',
        sortable: true,
        "class": 'text-center'
      }, {
        key: 'channel_type',
        label: 'Channel Type',
        sortable: true,
        "class": 'text-center'
      }, {
        key: 'actions',
        label: 'Action'
      }],
      totalRows: 1,
      currentPage: 1,
      perPage: this.$perPage,
      pageOptions: this.$pageOptions,
      sortBy: 'id',
      sortDesc: true,
      sortDirection: 'desc',
      filter: null,
      filterOn: [],

      /*sectionStyle : 'style_1',
      max_visible_units : 12,
      max_col_in_single_row : 3,*/
      //create_new : null,
      //edit_record : null,
      customers: [],
      b2bCustomerInfoPopupState: false,
      b2bCustomerId: '',
      b2bCustomerInfoById: null
    };
  },
  computed: {
    sortOptions: function sortOptions() {
      // Create an options list from our fields
      return this.fields.filter(function (f) {
        return f.sortable;
      }).map(function (f) {
        return {
          text: f.label,
          value: f.key
        };
      });
    }
  },
  mounted: function mounted() {
    // Inactive: 0, Active: 1, Pending: 2, Pending Approval: 3, Suspended: 4 => Status described of users
    // Set the initial number of items
    this.totalRows = this.customers.length;
  },
  created: function created() {
    var _this = this;

    this.$eventBus.$on('customersSaved', function (message) {
      _this.showMessage("success", message);

      _this.getCustomers();

      _this.create_new = null;
    });
    this.getCustomers();
  },
  methods: {
    showCustomerInfoModalMethod: function showCustomerInfoModalMethod(data) {
      this.b2bCustomerInfoById = data;
      this.b2bCustomerId = data.id;
      this.b2bCustomerInfoPopupState = true;
    },
    addFilter: function addFilter() {
      this.customers = [];
      this.totalRows = 1;
      this.currentPage = 1;
      this.offset = 0;
      this.getCustomers();
    },
    getCustomers: function getCustomers() {
      var _this2 = this;

      var vm = this;
      this.isLoading = true;
      axios.get(this.$apiUrl + '/customers').then(function (response) {
        _this2.isLoading = false;
        vm.isLoading = false;
        _this2.customers = response.data.data; //this.totalRows = this.customers.length

        _this2.totalRows = response.data.total;
      })["catch"](function (error) {
        var _error$request;

        vm.isLoading = false;
        console.log("error => ", error);

        if ((_error$request = error.request) !== null && _error$request !== void 0 && _error$request.statusText) {
          var _error$request2;

          _this2.showError((_error$request2 = error.request) === null || _error$request2 === void 0 ? void 0 : _error$request2.statusText);
        } else if (error.message) {
          _this2.showError(error.message);
        } else {
          _this2.showError(__('something_went_wrong'));
        }
      }); // alert("hello");
    },
    updateStatusCustomer: function updateStatusCustomer(index, id) {
      var _this3 = this;

      this.$swal.fire({
        title: "Are you Sure?",
        text: "You want to change status.",
        confirmButtonText: "Yes, Sure",
        cancelButtonText: "Cancel",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#37a279',
        cancelButtonColor: '#d33'
      }).then(function (result) {
        if (result.value) {
          _this3.isLoading = true;
          var postData = {
            id: id
          };
          axios.post(_this3.$apiUrl + '/customers/change', postData).then(function (response) {
            _this3.isLoading = false; //this.customers.splice(index, 1)

            _this3.getCustomers(); //this.showSuccess(response.data.message);


            _this3.showMessage("success", response.data.message);
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue":
/*!***************************************************************!*\
  !*** ./resources/js/views/Customers/B2bCustomerInfoPopup.vue ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7& */ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7&");
/* harmony import */ var _B2bCustomerInfoPopup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./B2bCustomerInfoPopup.vue?vue&type=script&lang=js& */ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _B2bCustomerInfoPopup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__.render,
  _B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Customers/B2bCustomerInfoPopup.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/Customers/Customers.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/Customers/Customers.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Customers.vue?vue&type=template&id=0aa4382c& */ "./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c&");
/* harmony import */ var _Customers_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Customers.vue?vue&type=script&lang=js& */ "./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Customers_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__.render,
  _Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Customers/Customers.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_B2bCustomerInfoPopup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./B2bCustomerInfoPopup.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_B2bCustomerInfoPopup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Customers_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Customers.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Customers_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   staticRenderFns: () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_B2bCustomerInfoPopup_vue_vue_type_template_id_3e5d9ca7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7&");


/***/ }),

/***/ "./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   staticRenderFns: () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Customers_vue_vue_type_template_id_0aa4382c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Customers.vue?vue&type=template&id=0aa4382c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/B2bCustomerInfoPopup.vue?vue&type=template&id=3e5d9ca7& ***!
  \*************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render),
/* harmony export */   staticRenderFns: () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "card" }, [
    _c("div", { staticClass: "card-body" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-12" }, [
          _c("table", { staticClass: "table table-bordered" }, [
            _c(
              "tbody",
              [
                _vm.b2bCustomerInfoByID.name
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [_vm._v("Name")]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.b2bCustomerInfoByID.name))]),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.email
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [_vm._v("Email")]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(_vm.b2bCustomerInfoByID.email))]),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.mobile
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [_vm._v("Mobile")]),
                      _vm._v(" "),
                      _c(
                        "td",
                        [
                          _vm.b2bCustomerInfoByID.country_code
                            ? [
                                _vm._v(
                                  "+" +
                                    _vm._s(_vm.b2bCustomerInfoByID.country_code)
                                ),
                              ]
                            : _vm._e(),
                          _vm._v(
                            "\n                                " +
                              _vm._s(_vm.b2bCustomerInfoByID.mobile) +
                              "\n                            "
                          ),
                        ],
                        2
                      ),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.referral_code
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [
                        _vm._v("Referral Code"),
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(_vm.b2bCustomerInfoByID.referral_code)),
                      ]),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.stripe_id
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [
                        _vm._v("Stripe Id"),
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(_vm._s(_vm.b2bCustomerInfoByID.stripe_id)),
                      ]),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.created_at
                  ? _c("tr", [
                      _c("th", { staticClass: "th-width" }, [
                        _vm._v("Created Date"),
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v(
                          _vm._s(
                            new Date(
                              _vm.b2bCustomerInfoByID.created_at
                            ).toLocaleString()
                          )
                        ),
                      ]),
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.b2bCustomerInfoByID.b2b_details
                  ? [
                      _vm._m(0),
                      _vm._v(" "),
                      _vm.b2bCustomerInfoByID.name
                        ? _c("tr", [
                            _c("th", { staticClass: "th-width" }, [
                              _vm._v("Customer Segment"),
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(
                                _vm._s(
                                  _vm.b2bCustomerInfoByID &&
                                    _vm.b2bCustomerInfoByID.sales_channel
                                    ? _vm.b2bCustomerInfoByID.sales_channel.name
                                    : ""
                                )
                              ),
                            ]),
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Outlet Name"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details.outlet_name
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Legal Name"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details.legal_name
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Business Person Name"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details
                                .business_person_name
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Delivery Address"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details
                                .delivery_address
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [_vm._v("City")]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(_vm.b2bCustomerInfoByID.b2b_details.city)
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Pincode"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(_vm.b2bCustomerInfoByID.b2b_details.pincode)
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("State"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(_vm.b2bCustomerInfoByID.b2b_details.state)
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Pancard Number"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details.pan_number
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("td", { attrs: { colspan: "2" } }, [
                          _c("table", { staticClass: "table table-bordered" }, [
                            _vm._m(1),
                            _vm._v(" "),
                            _c("tr", [
                              _c(
                                "td",
                                { staticStyle: { "vertical-align": "top" } },
                                [
                                  _c("img", {
                                    staticClass: "img-fluid",
                                    attrs: {
                                      src: _vm.b2bCustomerInfoByID.b2b_details
                                        .pan_card_image,
                                      width: "300",
                                    },
                                  }),
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "td",
                                { staticStyle: { "vertical-align": "top" } },
                                [
                                  _c("img", {
                                    staticClass: "img-fluid",
                                    attrs: {
                                      src: _vm.b2bCustomerInfoByID.b2b_details
                                        .gst_certificate_image,
                                      width: "300",
                                    },
                                  }),
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "td",
                                { staticStyle: { "vertical-align": "top" } },
                                [
                                  _c("img", {
                                    staticClass: "img-fluid",
                                    attrs: {
                                      src: _vm.b2bCustomerInfoByID.b2b_details
                                        .fssai_certificate_image,
                                      width: "300",
                                    },
                                  }),
                                ]
                              ),
                            ]),
                          ]),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Fssai Number"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details.fssai_number
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Monthly Turnover"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              _vm.b2bCustomerInfoByID.b2b_details
                                .monthly_turnover
                            )
                          ),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("tr", [
                        _c("th", { staticClass: "th-width" }, [
                          _vm._v("Created Date"),
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _vm._v(
                            _vm._s(
                              new Date(
                                _vm.b2bCustomerInfoByID.b2b_details.created_at
                              ).toLocaleString()
                            )
                          ),
                        ]),
                      ]),
                    ]
                  : _vm._e(),
              ],
              2
            ),
          ]),
        ]),
      ]),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c(
        "th",
        {
          staticClass: "th-width",
          staticStyle: { "font-size": "20px", color: "#000000" },
          attrs: { colspan: "2" },
        },
        [
          _vm._v(
            "\n                                    B2B Store Info\n                                "
          ),
        ]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", [_vm._v("Pancard")]),
      _vm._v(" "),
      _c("th", [_vm._v("Certificate")]),
      _vm._v(" "),
      _c("th", [_vm._v("Fssai")]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Customers/Customers.vue?vue&type=template&id=0aa4382c& ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render),
/* harmony export */   staticRenderFns: () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("div", { staticClass: "page-heading" }, [
        _c("div", { staticClass: "page-title" }, [
          _c("div", { staticClass: "row" }, [
            _vm._m(0),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-12 col-md-6 order-md-2 order-first" },
              [
                _c(
                  "nav",
                  {
                    staticClass: "breadcrumb-header float-start float-lg-end",
                    attrs: { "aria-label": "breadcrumb" },
                  },
                  [
                    _c("ol", { staticClass: "breadcrumb" }, [
                      _c(
                        "li",
                        { staticClass: "breadcrumb-item" },
                        [
                          _c("router-link", { attrs: { to: "/dashboard" } }, [
                            _vm._v(_vm._s(_vm.__("dashboard"))),
                          ]),
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "li",
                        {
                          staticClass: "breadcrumb-item active",
                          attrs: { "aria-current": "page" },
                        },
                        [_vm._v("Customers List")]
                      ),
                    ]),
                  ]
                ),
              ]
            ),
          ]),
        ]),
        _vm._v(" "),
        _c("section", { staticClass: "section" }, [
          _c("div", { staticClass: "card" }, [
            _vm._m(1),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "card-body" },
              [
                _c(
                  "b-row",
                  { staticClass: "mb-2" },
                  [
                    _c(
                      "b-col",
                      { attrs: { md: "3", "offset-md": "8" } },
                      [
                        _c("h6", { staticClass: "box-title" }, [
                          _vm._v("Search"),
                        ]),
                        _vm._v(" "),
                        _c("b-form-input", {
                          attrs: {
                            id: "filter-input",
                            type: "search",
                            placeholder: "Search",
                          },
                          on: {
                            click: function ($event) {
                              return _vm.addFilter()
                            },
                          },
                          model: {
                            value: _vm.filter,
                            callback: function ($$v) {
                              _vm.filter = $$v
                            },
                            expression: "filter",
                          },
                        }),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      { staticClass: "text-center", attrs: { md: "1" } },
                      [
                        _c(
                          "button",
                          {
                            directives: [
                              {
                                name: "b-tooltip",
                                rawName: "v-b-tooltip.hover",
                                modifiers: { hover: true },
                              },
                            ],
                            staticClass: "btn btn-primary btn_refresh",
                            attrs: { title: _vm.__("refresh") },
                            on: {
                              click: function ($event) {
                                return _vm.getCustomers()
                              },
                            },
                          },
                          [
                            _c("i", {
                              staticClass: "fa fa-refresh",
                              attrs: { "aria-hidden": "true" },
                            }),
                          ]
                        ),
                      ]
                    ),
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "table-responsive" },
                  [
                    _c("b-table", {
                      attrs: {
                        items: _vm.customers,
                        fields: _vm.fields,
                        "current-page": _vm.currentPage,
                        "per-page": _vm.perPage,
                        filter: _vm.filter,
                        "filter-included-fields": _vm.filterOn,
                        "sort-by": _vm.sortBy,
                        "sort-desc": _vm.sortDesc,
                        "sort-direction": _vm.sortDirection,
                        bordered: true,
                        busy: _vm.isLoading,
                        stacked: "md",
                        "show-empty": "",
                        small: "",
                      },
                      on: {
                        "update:sortBy": function ($event) {
                          _vm.sortBy = $event
                        },
                        "update:sort-by": function ($event) {
                          _vm.sortBy = $event
                        },
                        "update:sortDesc": function ($event) {
                          _vm.sortDesc = $event
                        },
                        "update:sort-desc": function ($event) {
                          _vm.sortDesc = $event
                        },
                      },
                      scopedSlots: _vm._u([
                        {
                          key: "table-busy",
                          fn: function () {
                            return [
                              _c(
                                "div",
                                { staticClass: "text-center text-black my-2" },
                                [
                                  _c("b-spinner", {
                                    staticClass: "align-middle",
                                  }),
                                  _vm._v(" "),
                                  _c("strong", [
                                    _vm._v(_vm._s(_vm.__("loading")) + "..."),
                                  ]),
                                ],
                                1
                              ),
                            ]
                          },
                          proxy: true,
                        },
                        {
                          key: "cell(email)",
                          fn: function (row) {
                            return [
                              _vm._v(
                                "\n                                " +
                                  _vm._s(_vm._f("emailMask")(row.item.email)) +
                                  "\n                            "
                              ),
                            ]
                          },
                        },
                        {
                          key: "cell(mobile)",
                          fn: function (row) {
                            return [
                              _vm._v(
                                "\n                                " +
                                  _vm._s(
                                    _vm._f("mobileMask")(row.item.mobile)
                                  ) +
                                  "\n                            "
                              ),
                            ]
                          },
                        },
                        {
                          key: "cell(status)",
                          fn: function (row) {
                            return [
                              row.item.status == 1
                                ? _c(
                                    "span",
                                    { staticClass: "badge bg-success" },
                                    [_vm._v("Active")]
                                  )
                                : _c(
                                    "span",
                                    { staticClass: "badge bg-danger" },
                                    [_vm._v("Deactive")]
                                  ),
                            ]
                          },
                        },
                        {
                          key: "cell(created_at)",
                          fn: function (row) {
                            return [
                              _vm._v(
                                "\n                                " +
                                  _vm._s(
                                    new Date(
                                      row.item.created_at
                                    ).toLocaleString()
                                  ) +
                                  "\n                            "
                              ),
                            ]
                          },
                        },
                        {
                          key: "cell(channel_type)",
                          fn: function (row) {
                            return [
                              row.item.customer_type == "0"
                                ? [_vm._v("B2C")]
                                : [_vm._v("B2B")],
                            ]
                          },
                        },
                        {
                          key: "cell(actions)",
                          fn: function (row) {
                            return [
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-sm",
                                  on: {
                                    click: function ($event) {
                                      return _vm.updateStatusCustomer(
                                        row.index,
                                        row.item.id
                                      )
                                    },
                                  },
                                },
                                [
                                  row.item.status == 1
                                    ? _c(
                                        "span",
                                        { staticClass: "primary-toggal" },
                                        [
                                          _c("i", {
                                            staticClass:
                                              "fa fa-toggle-on fa-2x",
                                          }),
                                        ]
                                      )
                                    : _c(
                                        "span",
                                        { staticClass: "text-danger" },
                                        [
                                          _c("i", {
                                            staticClass:
                                              "fa fa-toggle-off fa-2x",
                                          }),
                                        ]
                                      ),
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "button",
                                {
                                  staticClass:
                                    "btn btn-sm btn-success offset-2",
                                  on: {
                                    click: function ($event) {
                                      return _vm.showCustomerInfoModalMethod(
                                        row.item
                                      )
                                    },
                                  },
                                },
                                [_c("i", { staticClass: "fa fa-eye" })]
                              ),
                            ]
                          },
                        },
                      ]),
                    }),
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "b-row",
                  [
                    _c("b-col", { staticClass: "my-1", attrs: { md: "2" } }, [
                      _c(
                        "label",
                        [
                          _c(
                            "b-form-group",
                            {
                              staticClass: "mb-0",
                              attrs: {
                                label: _vm.__("per_page"),
                                "label-for": "per-page-select",
                                "label-align-sm": "right",
                                "label-size": "sm",
                              },
                            },
                            [
                              _c("b-form-select", {
                                staticClass: "form-control form-select",
                                attrs: {
                                  id: "per-page-select",
                                  options: _vm.pageOptions,
                                  size: "sm",
                                },
                                on: { change: _vm.addFilter },
                                model: {
                                  value: _vm.perPage,
                                  callback: function ($$v) {
                                    _vm.perPage = $$v
                                  },
                                  expression: "perPage",
                                },
                              }),
                            ],
                            1
                          ),
                        ],
                        1
                      ),
                    ]),
                    _vm._v(" "),
                    _c(
                      "b-col",
                      {
                        staticClass: "my-1",
                        attrs: { md: "4", "offset-md": "6" },
                      },
                      [
                        _c("label", [
                          _vm._v("Total Records:- " + _vm._s(_vm.totalRows)),
                        ]),
                        _vm._v(" "),
                        _c("b-pagination", {
                          staticClass: "my-0",
                          attrs: {
                            "total-rows": _vm.totalRows,
                            "per-page": _vm.perPage,
                            align: "fill",
                            size: "sm",
                          },
                          model: {
                            value: _vm.currentPage,
                            callback: function ($$v) {
                              _vm.currentPage = $$v
                            },
                            expression: "currentPage",
                          },
                        }),
                      ],
                      1
                    ),
                  ],
                  1
                ),
              ],
              1
            ),
          ]),
        ]),
      ]),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          attrs: { size: "xl", title: "Customer Info" },
          model: {
            value: _vm.b2bCustomerInfoPopupState,
            callback: function ($$v) {
              _vm.b2bCustomerInfoPopupState = $$v
            },
            expression: "b2bCustomerInfoPopupState",
          },
        },
        [
          _c("b2b-customer-info-popup", {
            attrs: {
              b2bCustomerInfoByID: _vm.b2bCustomerInfoById,
              b2bCustomerID: _vm.b2bCustomerId,
            },
          }),
        ],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-12 col-md-6 order-md-1 order-last" }, [
      _c("h3", [_vm._v("Customers List")]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h4", { staticClass: "card-title" }, [_vm._v("Customers")]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);