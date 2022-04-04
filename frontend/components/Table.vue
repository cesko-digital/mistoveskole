<template>
  <client-only>
    <ve-table
      v-if="tableData.length"
      ref="Table"
      :columns="columns"
      :table-data="tableData"
      row-key-field-name="ico"
      :max-height="600"
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
          width: '15%',
        },
        {
          field: 'ico',
          key: 'ico',
          title: 'ICO',
          align: 'left',
          sortBy: '',
          width: '15%',
        },
        {
          field: 'schools',
          key: 'schools',
          title: 'Kapacity',
          align: 'left',
          width: '30%',
          renderBodyCell: ({ row, column, rowIndex }, h) => {
              return (<RowSchools row={row} />);
          },
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
