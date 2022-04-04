<template>
  <client-only>
    <ve-table
      v-if="tableData.length"
      ref="Table"
      :columns="columns"
      :table-data="tableData"
      row-key-field-name="ico"
      :max-height="500"
      :virtual-scroll-option="{
        enable: true,
      }"
      :sort-option="sortOption"
    />
  </client-only>
</template>

<script>
import _orderBy from 'lodash/orderBy';

export default {
  data() {
    return {
      sortOption: {
        sortChange: (params) => {
          this.sortChange(params);
        },
      },
      columns: [
        {
          field: 'name',
          key: 'name',
          title: 'Name',
          sortBy: '',
          align: 'left',
          width: '40%',
        },
        {
          field: 'okres',
          key: 'okres',
          title: 'Okres',
          sortBy: '',
          align: 'left',
          width: '20%',
        },
        {
          field: 'ico',
          key: 'ico',
          title: 'ICO',
          align: 'right',
          sortBy: '',
          width: '20%',
        },
      ],
      tableData: [],
    };
  },

  async mounted() {
    this.tableData = await this.$axios.$get('/skoly.json');
  },

  methods: {
    sortChange(params) {
      const fields = [];
      const values = [];

      Object.entries(params).forEach(([key, value]) => {
        if (value) {
          fields.push(key);
          values.push(value);
        }
      });

      this.tableData = _orderBy(this.tableData, fields, values);

      this.$refs.Table.scrollTo({ top: 0 });
    },
  },
};
</script>
