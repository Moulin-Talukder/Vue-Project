<template>
  <div class="container">
      <h2 class="text-center p-2 text-white bg-primary mt-5">Products</h2>


      <table class="table">
        <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">Product Name</th>
             <th scope="col">Description</th>
             <th scope="col">Price</th>
             <th scope="col">Quantity</th>
             <th scope="col">Action</th>
           </tr>
        </thead>

        <tbody v-for="product in products" :key="product.id">
             <tr>
                <td scope="row">{{product.id}}</td>
                <td scope="row">{{product.Name}}</td>
                <td scope="row">{{product.Description}}</td>
                <td scope="row">{{product.Price}}</td>
                <td scope="row">{{product.Qty}}</td>
                <td><button class="btn btn-danger btn-sm" type="submit" @click.prevent="deleteProduct(product.id)">Delete</button></td>
             </tr>
        </tbody>
      </table>


  </div>
</template>

<script>
export default {

   name: 'Product_List',
   created(){
     this.loadData();
   },
   methods: {
     loadData(){
       let url = this.url = '/api/getProducts';
       this.axios.get(url).then(response => {
         this.products = response.data
         console.log(this.products);
       });
     },
     deleteProduct(id){
       let url = this.url + '/api/deleteProducts/${id}';
       this.axios.delete(url).then(response => {
         if(response.status) {
            this.$utils.showSuccess('success', response.message);
         }else{
           this.$utils.showError('Error', response.message);
         }
       });
     }
     },
     mounted(){
       console.log('Product List Component Mounted');
     },
     data(){
       return{
         url: document.head.querySelector('meta[name="url"]').Content,
         products:[]
       }
     }
   

}
</script>

