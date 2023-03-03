<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
import Pagination from '../general/paginate.vue';
import BreezeButton from "@/Components/Button.vue";


</script>
<script>
console.log(this);
export default {
  components: {
    Pagination,
  },
  props: {
    items: Object,
    products: {
        type: Object,
        default: () => ({}),
    },
  },
}
</script>




<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product</h2>
        </template>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <div>
                    <div class="row">
                    <div class="col-md-10">
                        <form @submit="search">
                        <!-- <input type="text" v-model="searchData.searchData" class="form-controll" /> -->
                        </form>
                    </div>
                    <div class="col-md-2">
                        <!-- <router-link :to="{name: 'prodCreate'}" class="btn btn-primary">Create Product</router-link> -->
                        <!-- <br> -->
                        <!-- <br> -->
                        <!-- <router-link :to="{name: 'prodImport'}" class="btn btn-primary">Import Products</router-link> -->
                        <!-- <br>
                        <br> -->
                        <!-- <button class="btn btn-primary" @click="exportProduct">Export Products</button> -->
                    </div>
                    </div><br />

                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Item Name</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Item content</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Item cate?? posst ???</th>
                                <th colspan='2' scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            <tr v-for="prod in products['data']" :key="prod.id">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ prod.id }}</td>
                                <td>{{ prod.name }}</td>
                                <td>{{ prod.price }}</td>
                                <td>{{ prod.postname }}</td>
                                <td><Link href="#" class="px-4 py-2 text-white bg-blue-600 rounded-lg" >Edit</Link></td>
                                <td><button class="bg-red-600" @click="deletePost(prod.id)">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :links="products['meta']['links']" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
