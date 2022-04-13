<template>
  <div>
    <client-only>
      <ve-table
        v-if="tableData.length"
        ref="Table"
        :columns="columns"
        :table-data="tableData"
        :expand-option="expandOption"
        row-key-field-name="Id"
        :max-height="600"
        :virtual-scroll-option="{
          enable: true,
        }"
        :sort-option="sortOption"
      />
    </client-only>
  </div>
</template>

<script>
import _orderBy from 'lodash/orderBy';
import _cloneDeep from 'lodash/cloneDeep';

export default {
  data() {
    return {
      sortOption: {
        sortChange: (params) => {
          this.sortChange(params);
        },
      },
      expandOption: {
        render: ({ row, column, rowIndex }, h) => {
          return (<RowDetail row={row} />);
        },
      },
      sourceData: [],
      tableData: [],
    };
  },

  computed: {
    columns() {
      return [
        {
          field: '',
          key: 'expand',
          type: 'expand',
          title: '',
          width: 50,
          align: 'center',
        },
        {
          field: 'Id Jazyk',
          key: 'Id Jazyk',
          title: 'Jazyk',
          sortBy: '',
          filter: {
            isMultiple: true,
            filterList: this.getFilterValues('Id Jazyk'),
            filterConfirm: (filterList) => this.filterByField('Id Jazyk', filterList),
            filterReset: () => this.filterByField('Id Jazyk', []),
          },
        },
        {
          field: 'Id Reditelstvi Id Okres Id Kraj Jmeno Cz',
          key: 'Id Reditelstvi Id Okres Id Kraj Jmeno Cz',
          title: 'Kraj',
          sortBy: '',
          filter: {
            isMultiple: true,
            filterList: this.getFilterValues('Id Reditelstvi Id Okres Id Kraj Jmeno Cz'),
            filterConfirm: (filterList) => this.filterByField('Id Reditelstvi Id Okres Id Kraj Jmeno Cz', filterList),
            filterReset: () => this.filterByField('Id Reditelstvi Id Okres Id Kraj Jmeno Cz', []),
          },
        },
        {
          field: 'Id Reditelstvi Id Okres Jmeno Cz',
          key: 'Id Reditelstvi Id Okres Jmeno Cz',
          title: 'Město',
          sortBy: '',
          filter: {
            isMultiple: true,
            filterList: this.getFilterValues('Id Reditelstvi Id Okres Jmeno Cz'),
            filterConfirm: (filterList) => this.filterByField('Id Reditelstvi Id Okres Jmeno Cz', filterList),
            filterReset: () => this.filterByField('Id Reditelstvi Id Okres Jmeno Cz', []),
          },
        },
        {
          field: 'Id Reditelstvi Red Izo',
          key: 'Id Reditelstvi Red Izo',
          title: 'Id Reditelstvi Red Izo',
          sortBy: '',
          filterCustom: {
            defaultVisible: true,
            render: ({ showFn, closeFn }, h) => {
              return (<FilterSearch
                on-search={(payload) => this.filterSearch('Id Reditelstvi Red Izo', payload)}
              />);
            },
          },
        },
        {
          field: 'Id Reditelstvi Red Plny Nazev',
          key: 'Id Reditelstvi Red Plny Nazev',
          title: 'Nazev',
          sortBy: '',
          align: 'left',
          filterCustom: {
            defaultVisible: true,
            render: ({ showFn, closeFn }, h) => {
              return (<FilterSearch
                on-search={(payload) => this.filterSearch('Id Reditelstvi Red Plny Nazev', payload)}
              />);
            },
          },
        },
        {
          field: 'Id Skola Typ',
          key: 'Id Skola Typ',
          title: 'Typ',
          sortBy: '',
          filter: {
            isMultiple: true,
            filterList: this.getFilterValues('Id Skola Typ'),
            filterConfirm: (filterList) => this.filterByField('Id Skola Typ', filterList),
            filterReset: () => this.filterByField('Id Skola Typ', []),
          },
        },
        {
          field: 'Izo',
          key: 'Izo',
          title: 'Izo',
          sortBy: '',
          filterCustom: {
            defaultVisible: true,
            render: ({ showFn, closeFn }, h) => {
              return (<FilterSearch
                on-search={(payload) => this.filterSearch('Izo', payload)}
              />);
            },
          },
        },
        {
          field: 'Kapacita Uk Volno Celkem',
          key: 'Kapacita Uk Volno Celkem',
          title: 'Kapacita',
          sortBy: '',
        },
        {
          field: 'Misto Ruian Kod',
          key: 'Misto Ruian Kod',
          title: 'Ruian',
          sortBy: '',
          filterCustom: {
            defaultVisible: true,
            render: ({ showFn, closeFn }, h) => {
              return (<FilterSearch
                on-search={(payload) => this.filterSearch('Misto Ruian Kod', payload)}
              />);
            },
          },
        },
        // {
        //   field: 'schools',
        //   key: 'schools',
        //   title: 'Kapacity',
        //   align: 'left',
        //   width: '30%',
        //   renderBodyCell: ({ row, column, rowIndex }, h) => {
        //       return (<RowSchools row={row} />);
        //   },
        // },
      ];
    },
  },

  async mounted() {
    this.sourceData = await this.$axios.$get('https://s3.eu-central-1.wasabisys.com/treevio/demo/export_zarizeni_2022_04_08_11_11_11.json');
    this.tableData = _cloneDeep(this.sourceData);
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
    getFilterValues(key) {
      const data = [...new Set(this.sourceData.map((item) => item[key]))];
      return data.map((item) => ({
        value: item,
        label: item,
        selected: false,
      }));
    },
    filterByField(field, filterList) {
      const filterValues = [...filterList].filter((item) => item.selected).map((item) => item.label);
      this.tableData = _cloneDeep(this.sourceData).filter((item) => filterValues.length === 0 || filterValues.includes(item[field]));
    },
    filterSearch(field, value) {
      this.tableData = _cloneDeep(this.sourceData).filter((item) => value.length === 0 || String(item[field]).toLowerCase().includes(value.toLowerCase()));
    },
  },
};
</script>

<style>
.ve-table .ve-table-container table.ve-table-content thead.ve-table-header tr.ve-table-header-tr th.ve-table-header-th {
  white-space: nowrap;
  padding-right: 20px;
}
.ve-dropdown-popper .ve-dropdown-dd {
  display: none;
}
.ve-dropdown-popper .ve-dropdown-dd.ve-dropdown-dd-show {
  display: block;
}
</style>
