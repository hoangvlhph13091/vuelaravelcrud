import paginate from '../general/paginate.vue';
export default {
    name:'products',
    components: { paginate },
        data() {
          return {
            productsCollection: [],
            searchData: {},
            links: {},
            file: {},
          }
        },
        methods: {
          deletePost(id) {
            // this.axios?.get(this.$baseurl+'prod/delete/'+id).then(response => {
            // let i = this.products.map(item => item.id).indexOf(id);
            // this.products.splice(i, 1)
            // });
          },
          async exportProduct(){
            //   const config = {responseType: 'blob'}
            //   const response = await this.axios.post(this.$baseurl+'prod/export', '', config )

            //       const href = URL.createObjectURL(response.data);

            //       const link = document.createElement('a');
            //       link.href = href;
            //       link.setAttribute('download', 'products.csv');
            //       document.body.appendChild(link);
            //       link.click();

            //       document.body.removeChild(link);
            //       URL.revokeObjectURL(href);

          },
          async search(e){
            // e.preventDefault();
            // const response = await this.axios.post(this.$baseurl, this.searchData);
            // this.posts = response.data.data;
          },
          async changePage(PageUrl){
            const response = await this.axios.get(PageUrl);
            this.products = response.data.data;
            this.links = response.data.meta.links
          },
          async importExcel(e){
            // const response = await this.axios.get(this.$baseurl+'prod/import');
            // console.log(response);
            // this.products = response.data.data;
            // this.links = response.data.meta.links

          }
        },
        async created() {
        try {
          const response = await this.axios.get(this.$baseurl+'prod/')
          this.productsCollection = response.data.data;
          this.links = response.data.meta.links
        } catch (e) {
          this.errors.push(e)
        }
      },
    }
