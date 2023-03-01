<template>
    <div>
        <div class="flex flex-wrap mt-8">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li :class="link.active == true ? 'page-item active' : 'page-item'" v-for="link in links" :key="link.id">
                <a v-if="link.url != null" class="page-link disabled" v-html="link.label" :href="link.url" @click="changePage"></a>
                <a v-if="link.url == null" class="page-link disabled" v-html="link.label" :href="link.url"></a>
              </li>
            </ul>
          </nav>
        </div>
    </div>
</template>

<script>
export default {
  name: 'paginate',
  props: {
        links: {type: Object}
    },
  data() {
        return {

        }
    },
  methods: {
      changePage(e){
      e.preventDefault();
      const PageUrl = e.target.href;
      this.$emit('changePage', PageUrl)

    }
  },
  mounted() {
  },
}
</script>
