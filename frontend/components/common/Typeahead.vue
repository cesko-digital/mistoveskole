<template>
  <div :id="wrapperId" class="typeahead">
    <InputWrapper>
      <SearchIcon class="stroke-icon-muted" />

      <input
        :id="inputId"
        ref="input"
        v-model="query"
        class="wrapped-input typeahead-input"
        type="text"
        :placeholder="placeholder"
        autocomplete="off"
        @input="onInput"
        @focus="onFocus"
        @blur="onBlur"
        @keydown.down.prevent="onArrowDown"
        @keydown.up.prevent="onArrowUp"
        @keydown.enter.tab.prevent="selectCurrentSelection"
      >
    </InputWrapper>

    <div v-if="isListVisible" ref="list" class="typeahead-list">
      <div
        v-for="(item, index) in items"
        :key="item.slug"
        class="typeahead-list-item"
        :class="{
          'typeahead-list-item--active': currentSelectionIndex == index,
        }"
        @mousedown.prevent
        @click="selectItem(item)"
        @mouseenter="currentSelectionIndex = index"
      >
        <span
          class="typeahead-list-item-text"
          v-html="boldMatchText(item.name)"
        />
      </div>
    </div>
  </div>
</template>

<script>
import isResponseOk from '~/utils/isResponseOk';
import responseToObj from '~/utils/responseToObj';
import SearchIcon from '~/assets/images/icons/search.svg?inline';

/**
 * @typedef {Object} Item
 * @property {string} name
 * @property {string} slug
 * @property {boolean} isPlace
 */

export default {
  components: {
    SearchIcon,
  },
  props: {
    id: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    source: {
      required: true,
    },
  },
  emits: ['change'],
  data() {
    return {
      inputId: `typeahead_${
        typeof this.id === 'string' && this.id.length
          ? this.id
          : (Math.random() * 1000).toFixed()
      }_input`,
      query: '',
      isInputFocused: false,
      currentSelectionIndex: 0,
      items: [],
    };
  },
  computed: {
    wrapperId() {
      return `typeahead_${this.inputId}_wrapper`;
    },
    isListVisible() {
      return (
        this.isInputFocused &&
        this.items.length
      );
    },
    currentSelection() {
      return this.isListVisible &&
        this.currentSelectionIndex < this.items.length
        ? this.items[this.currentSelectionIndex]
        : undefined;
    },
  },
  methods: {
    onInput($event) {
      this.getItemsFromSource(this.source, this.query);

      if (
        this.isListVisible &&
        this.currentSelectionIndex >= this.items.length
      ) {
        this.currentSelectionIndex = (this.items.length || 1) - 1;
      }
    },
    onFocus() {
      this.isInputFocused = true;
    },
    onBlur() {
      this.isInputFocused = false;
    },
    onArrowDown($event) {
      if (
        this.isListVisible &&
        this.currentSelectionIndex < this.items.length - 1
      ) {
        this.currentSelectionIndex++;
      }
      this.scrollSelectionIntoView();
    },
    onArrowUp($event) {
      if (this.isListVisible && this.currentSelectionIndex > 0) {
        this.currentSelectionIndex--;
      }
      this.scrollSelectionIntoView();
    },
    scrollSelectionIntoView() {
      setTimeout(() => {
        const listNode = this.$refs.list;
        const activeNode = listNode.querySelector(
          '.typeahead-list-item.typeahead-list-item--active',
        );

        if (
          !(
            activeNode.offsetTop >= listNode.scrollTop &&
            activeNode.offsetTop + activeNode.offsetHeight <
              listNode.scrollTop + listNode.offsetHeight
          )
        ) {
          let scrollTo = 0;
          if (activeNode.offsetTop > listNode.scrollTop) {
            scrollTo =
              activeNode.offsetTop +
              activeNode.offsetHeight -
              listNode.offsetHeight;
          } else if (activeNode.offsetTop < listNode.scrollTop) {
            scrollTo = activeNode.offsetTop;
          }

          listNode.scrollTo(0, scrollTo);
        }
      });
    },
    selectCurrentSelection() {
      if (this.currentSelection) {
        this.selectItem(this.currentSelection);
      }
    },
    /**
     * @param {Item} item
     */
    selectItem(item) {
      this.query = item.name;
      this.currentSelectionIndex = 0;
      this.$refs.input.blur();
      this.$emit('change', { item });
    },
    /**
     * @param {string} str
     */
    escapeRegExp(str) {
      return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    },
    /**
     * @param {string} text
     */
    boldMatchText(text) {
      const regexp = new RegExp(`(${this.escapeRegExp(this.query)})`, 'ig');
      return text.replace(regexp, '<strong>$1</strong>');
    },
    /**
     * @param {any} source
     * @param {String} query
     */
    getItemsFromSource(source, query) {
      if (source instanceof URL) {
        this.getItemsFromUrl(source, query);
      } else {
        throw new TypeError('source type is not supported');
      }
    },
    /**
     * @param {URL} url
     * @param {String} query
     */
    getItemsFromUrl(url, query) {
      url.searchParams.set('q', query);

      fetch(url)
        .then(isResponseOk)
        .then(responseToObj)
        .then((result) => {
          this.items = result.results.pois.map((p) => ({
            name: p.name,
            slug: encodeURIComponent(p.id + '-' + p.slug),
            isPlace: false,
          }));
        });
    },
  },
};
</script>

<style scoped>
.typeahead {
  @apply relative flex;
}

.typeahead .typeahead-list {
  @apply absolute bg-white top-full z-10 w-full overflow-y-auto max-h-[calc(100vh/2)] rounded-outer shadow-xl mt-xs;
  border: 0.1rem solid #d1d1d1;
}
.typeahead .typeahead-list .typeahead-list-item {
  @apply cursor-pointer px-s py-xs;
  border-bottom: 0.1rem solid #d1d1d1;
}
.typeahead .typeahead-list .typeahead-list-item:last-child {
  border-bottom: none;
}

.typeahead .typeahead-list .typeahead-list-item.typeahead-list-item--active {
  background-color: #e1e1e1;
}
</style>
