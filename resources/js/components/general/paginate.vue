<script>
export default {
  props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 3
    },
    totalPages: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  },
  computed: {
    startPage() {
      // When on the first page
      if (this.currentPage === 1) {
        return 1;
      }
      // When on the last page
      if (this.currentPage === this.totalPages) {
        return this.totalPages - this.maxVisibleButtons;
      }
      // When in between
      return this.currentPage - 1;
    },
    pages() {
      const range = [];

      for (let i = this.startPage;
        i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
        i+= 1 ) {
        range.push({
          name: i,
          isDisabled: i === this.currentPage
        });
      }

      return range;
    },
  }
};
</script>
<template>
  <ul>
    <li>
      <button type="button">
        First
      </button>
    </li>
    <li>
      <button type="button">
        Previous
      </button>
    </li>
    <!-- Range of pages -->
    <li>
      <button type="button">
        Next
      </button>
    </li>
    <li>
      <button type="button">
        Last
      </button>
    </li>
  </ul>
</template>
