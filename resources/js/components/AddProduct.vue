<template>
  <div>
      <div class="container">
          <h2 class="text-center p-2 text-white bg-primary mt-5">Add Product</h2>

          <div class="card-body">
              <div class="col-md-6 offset-md-3">
                  <form id="validateForm" @submit.prevent="saveProduct" enctype="multipart/form-data" novalidate>

                  <div class="alert alert-danger" v-if="errors.length">
                  <ul class="mb-0">
                      <li v-for="(error, index) in errors" :key="index">
                          {{error}}


                      </li>
                  </ul>
        </div>

                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" id="name" v-model="product.Name" class="form-control" placeholder="Enter Name" >
                      </div>

                      <div class="form-group">
                          <label for="slug">Slug</label>
                          <input type="text" id="slug"
                          v-model="product.Slug"
                         class="form-control" placeholder="Enter Slug" >
                      </div>

                      <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" id="Description" v-model="product.Description" class="form-control" placeholder="Enter Description" >
                      </div>

                      <div class="form-group">
                          <label for="price">Price</label>
                          <input type="text" id="price" v-model="product.Price" class="form-control" placeholder="Enter Price" >
                      </div>

                      <div class="form-group">
                          <label for="qty">Quantity</label>
                          <input type="text" id="qty" v-model="product.Qty" class="form-control" placeholder="Enter Quantity" >
                      </div>

                     <div class="custom-file">
                         <input type="file" name="Image" class="custom-file-input" id="validatedCustomFile" v-on:change="saveImage">
                         <label class="custom-file-label" for="validateCustomFile">Choose file...</label>
                     </div>


                   <button type="submit" class="btn btn-primary mt-4">Submit</button>
                


                  </form>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            url: document.head.querySelector('meta[name="url"]').content,
            product: {},
            Name:'',
            Slug:'',
            Description:'',
            Price:'',
            Qty:'',
            Image:'',
            errors: []


        }
    },
    methods: {
        saveProduct() {
            this.errors = [];
            if(!this.product.Name) {
                this.errors.push('Name is required');
            }
            if(!this.product.Slug) {
                this.errors.push('Slug is required');
            }
            if(!this.product.Description) {
                this.errors.push('Description is required');
            }
            if(!this.product.Price) {
                this.errors.push('Price is required');
            }
            if(!this.product.Qty) {
                this.errors.push('Qty is required');
            }


            if(!this.errors.length){
                let formData = new FormData();
                formData.append('Name', this.product.Name);
                formData.append('Slug', this.product.Slug);
                formData.append('Description', this.product.Description);
                formData.append('Price', this.product.Price);
                formData.append('Qty', this.Qty);
                formData.append('Image', this.product.Image);
               
                let url = this.url + '/api/save_product';
                this.axios.post(url, formData).then((response) => {
                    if(response.status) {
                           this.$utils.showSuccess('success', response.message);
                    } else {

                        this.$utils.showError('Error', response.message);

                    }
                }).catch(error => {
                    this.errors.push(error.response.data.error);
                });
            }
            
        },
        saveImage(e){
                this.Image = e.target.files[0];
                console.log(this.Image);
            }
    },
    mounted: function(){
        console.log('Add Products Component Loaded');
    }



}
</script>

<style>

</style>