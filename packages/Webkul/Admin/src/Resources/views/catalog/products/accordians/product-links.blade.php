<accordian :title="'{{ __($accordian['name']) }}'" :active="true">
    <div slot="body">

        <up-selling></up-selling>

        <cross-selling></cross-selling>

    </div>
</accordian>
@push('scripts')
<script type="text/x-template" id="up-selling-template">
    <div>
        <div class="control-group" :class="">
            <label>{{ __('admin::app.catalog.products.add-up-selling') }}</label>
            <input type="search" name="" class="control" v-model="query" v-on:keyup="findUpSellingProduct" value="productname" placeholder="{{ __('admin::app.catalog.products.add-up-selling-placeholder') }}"/>
            <span class="control-error" v-if=""></span>
            <div class="up-selling-list" id="up-selling-list" @v-if="results.length" v-bind:class="{ active: isActive}">
                <i class="icon cross-icon remove-filter" @click="removeupsellingbox" ></i>
                <div class="dropdown-container">
                    <ul>
                        <li v-for="(result,index) in results" :key="index" >
                            <a @click="selectUpSellingProduct(result.name,result.id)">@{{ result.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="linked-container" v-if="upsellingresults">
            <div class="linked-product" v-for="(upsellingresult,index) in upsellingresults" :key="index">
                <span class="linked-product-lable">@{{ upsellingresult.name }}</span>
                <i class="icon cross-icon remove-filter" @click="removeGroup(index)"></i>
                <input type="hidden[]" name="upsellingproduct" v-bind:value="upsellingresult.id">
            </div>
        </div>
    </div>
</script>

<script type="text/x-template" id="cross-selling-template">
    <div>
        <div class="control-group" :class="">
            <label>{{ __('admin::app.catalog.products.add-cross-selling') }}</label>
            <input type="text" name="" class="control" v-model="query" v-on:keyup="findCrossSellingProduct" value="" placeholder="{{ __('admin::app.catalog.products.add-cross-selling-placeholder') }}"/>
            <span class="control-error" v-if=""></span>
            <div class="up-selling-list" id="up-selling-list" @v-if="results.length" v-bind:class="{ active: isActive}">
                <i class="icon cross-icon remove-filter" @click="removecrosssellingbox" ></i>
                <div class="dropdown-container">
                    <ul>
                        <li v-for="(result,index) in results" :key="index" >
                            <a @click="selectCrossSellingProduct(result.name,result.id)">@{{ result.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="linked-container" v-if="crosssellingresults">
            <div class="linked-product" v-for="(crosssellingresult,index) in crosssellingresults" :key="index">
                <span class="linked-product-lable">@{{ crosssellingresult.name }}</span>
                <i class="icon cross-icon remove-filter" @click="removeGroupCross(index)"></i>
                <input type="hidden" name="" v-bind:value="crosssellingresult.id">
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('up-selling', {
        data(){
            return {
                query: '',
                results: [],
                isActive: false,
                productname : [],
                productid :'',
                upsellingresults :[],
                obj : {},
            }
            selected: ''
        },

        template: '#up-selling-template',

        methods: {
            findUpSellingProduct() {
                this.results = [];
                if(this.query.length >= 1 ) {
                    axios.get( '{{ route('admin.catalog.products.upsellingproduct') }}',{params: {query: this.query}}).then(response => {
                        this.isActive = true;
                        this.results = response.data;
                    });
                }
            },

            selectUpSellingProduct(productName, productId) {
                this.obj.id=productId;
                this.obj.name=productName;
                var id = this.upsellingresults.length + 1;
                var found = this.upsellingresults.some(function (el) {
                    this.isActive = false;
                    return el.name === productName;
                });
                if (!found) {
                    this.upsellingresults.push({id: productId, name: productName});
                    this.isActive = false;
                }
            },

            removeGroup (index) {
                //alert(index);
                this.upsellingresults.splice(index, 1);
            },
            removeupsellingbox() {
                this.isActive = false;
            }
        }
    });

    //cross selling
    Vue.component('cross-selling', {
        data() {
            return {
                query: '',
                results: [],
                isActive: false,
                productname : [],
                productid :'',
                crosssellingresults : [],
                obj : {},
            }
            selected: ''
        },

        template: '#cross-selling-template',

        methods: {
            findCrossSellingProduct() {
                this.results = [];
                if(this.query.length >= 1 ) {
                    axios.get( '{{ route('admin.catalog.products.upsellingproduct') }}',{params: {query: this.query}}).then(response => {
                        if(response.data >=1) {
                            this.isActive = true;
                            this.results = response.data;
                        } else {
                            this.isActive = true;
                            this.results = response.data;
                        }

                    });
                }
            },

            selectCrossSellingProduct(productName, productId) {
                this.obj.id=productId;
                this.obj.name=productName;
                var id = this.crosssellingresults.length + 1;

                var found = this.crosssellingresults.some(function (el) {
                    this.isActive = false;
                    return el.name === productName;
                });

                if (!found) {
                    this.crosssellingresults.push({id: productId, name: productName});
                    this.isActive = false;
                }
            },

            removeGroupCross (index) {
                this.crosssellingresults.splice(index, 1);
            },

            removecrosssellingbox() {
                this.isActive = false;
            }

        }
    });
</script>

@endpush