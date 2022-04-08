<template>
  <client-only>
    <ve-table
      v-if="tableData.length"
      ref="Table"
      :columns="columns"
      :table-data="tableData"
      row-key-field-name="Id"
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
          field: 'Id',
          key: 'Id',
          title: 'Id',
          sortBy: '',
        },
        {
          field: 'Id Jazyk',
          key: 'Id Jazyk',
          title: 'Jazyk',
          sortBy: '',
        },
        {
          field: 'Id Reditelstvi Id Okres Id Kraj Jmeno Cz',
          key: 'Id Reditelstvi Id Okres Id Kraj Jmeno Cz',
          title: 'Kraj',
          sortBy: '',
        },
        {
          field: 'Id Reditelstvi Id Okres Jmeno Cz',
          key: 'Id Reditelstvi Id Okres Jmeno Cz',
          title: 'Město',
          sortBy: '',
        },
        {
          field: 'Id Reditelstvi Red Izo',
          key: 'Id Reditelstvi Red Izo',
          title: 'Id Reditelstvi Red Izo',
          sortBy: '',
        },
        {
          field: 'Id Reditelstvi Red Plny Nazev',
          key: 'Id Reditelstvi Red Plny Nazev',
          title: 'Nazev',
          sortBy: '',
        },
        {
          field: 'Id Skola Typ',
          key: 'Id Skola Typ',
          title: 'Typ',
          sortBy: '',
        },
        {
          field: 'Izo',
          key: 'Izo',
          title: 'Izo',
          sortBy: '',
        },
        {
          field: 'Kapacita Uk Volno Celkem',
          key: 'Kapacita Uk Volno Celkem',
          title: 'Kapacita Uk Volno Celkem',
          sortBy: '',
        },
        {
          field: 'Kontakt Email',
          key: 'Kontakt Email',
          title: 'Email',
          sortBy: '',
        },
        {
          field: 'Kontakt Jmeno',
          key: 'Kontakt Jmeno',
          title: 'Jmeno',
          sortBy: '',
        },
        {
          field: 'Kontakt Telefon',
          key: 'Kontakt Telefon',
          title: 'Telefon',
          sortBy: '',
        },
        {
          field: 'Kontakt Www',
          key: 'Kontakt Www',
          title: 'Www',
          sortBy: '',
        },
        {
          field: 'Misto Adresa1',
          key: 'Misto Adresa1',
          title: 'Adresa1',
          sortBy: '',
        },
        {
          field: 'Misto Adresa2',
          key: 'Misto Adresa2',
          title: 'Adresa2',
          sortBy: '',
        },
        {
          field: 'Misto Adresa3',
          key: 'Misto Adresa3',
          title: 'Adresa3',
          sortBy: '',
        },
        {
          field: 'Misto Ruian Kod',
          key: 'Misto Ruian Kod',
          title: 'Ruian',
          sortBy: '',
        },
        {
          field: 'Poznamka Cz',
          key: 'Poznamka Cz',
          title: 'Poznamka Cz',
          sortBy: '',
        },
        {
          field: 'Poznamka Uk',
          key: 'Poznamka Uk',
          title: 'Poznamka Uk',
          sortBy: '',
        },
        {
          field: 'Skola Plny Nazev',
          key: 'Skola Plny Nazev',
          title: 'Skola Plny Nazev',
          sortBy: '',
        },
        // {
        //   field: 'name',
        //   key: 'name',
        //   title: 'Name',
        //   sortBy: '',
        //   align: 'left',
        //   width: '40%',
        // },
        // {
        //   field: 'okres',
        //   key: 'okres',
        //   title: 'Okres',
        //   sortBy: '',
        //   align: 'left',
        //   width: '15%',
        // },
        // {
        //   field: 'ico',
        //   key: 'ico',
        //   title: 'ICO',
        //   align: 'left',
        //   sortBy: '',
        //   width: '15%',
        // },
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
      ],
      tableData: [],
    };
  },

  async mounted() {
    this.tableData = await this.$axios.$get('https://s3.eu-central-1.wasabisys.com/treevio/demo/export_zarizeni_2022_04_08_11_11_11.json');
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

<style>
.ve-table .ve-table-container table.ve-table-content thead.ve-table-header tr.ve-table-header-tr th.ve-table-header-th {
  white-space: nowrap;
}
</style>
