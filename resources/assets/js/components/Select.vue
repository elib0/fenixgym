<template>
<span select="{{name}}" v-if="name && (required || value.length)">
  <select name="{{name}}" :multiple="multiple" :required="required" @focus="focus()">
    <option v-if="!value.length" value=""></option>
    <option v-else v-for="val in value" value="{{val}}" selected>{{val}}</option>
  </select>
</span>
<div class="btn-select" :class="{'btn-group btn-group-justified': justified}">
  <div class="btn-group" :class="{open: show}">
    <button v-el:btn type="button" class="btn btn-default dropdown-toggle"
      :disabled="disabled"
      @click="toggleDropdown()"
      @blur="search ? null : blur()"
      @keyup.esc="show = false"
    >
      <span class="btn-placeholder" v-show="!ajax && showPlaceholder">{{placeholder || text.notSelected}}</span>
      <span class="btn-content" v-show="!ajax">{{ selectedItems }}</span>
      <span class="btn-loader" v-show="ajax">{{text.loading}}</span>
      <span class="caret"></span>
      <span v-if="showResetButton&&value.length" class="close" @click="clear()">&times;</span>
    </button>
    <ul class="dropdown-menu">
      <template v-if="options.length">
        <li v-if="search" class="bs-searchbox">
          <input type="text" placeholder="{{searchText||text.search}}" class="form-control" autocomplete="off"
            v-el:search
            v-model="searchValue"
            @blur="blur()"
            @keyup.esc="show = false"
          />
        </li>
        <li v-for="option in options | filterBy searchValue" :id="option.value" style="position:relative">
          <a @mousedown.prevent="select(option.value)" style="cursor:pointer">
            {{ option.label }}
            <span class="glyphicon glyphicon-ok check-mark" v-show="isSelected(option.value)"></span>
          </a>
        </li>
      </template>
      <slot v-else></slot>
      <div class="notify" v-show="showNotify" transition="fadein">{{limitText}}</div>
    </ul>
  </div>
</div>
</template>

<script>
import callAjax from './utils/callAjax.js'
import coerceBoolean from './utils/coerceBoolean.js'
import translations from './translations.js'
let timeout

  export default {
    props: {
      options: {
        twoWay: true,
        type: Array,
        default() { return [] },
      },
      value: {
        twoWay: true
      },
      multiple: {
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      search: { // Allow searching (only works when options are provided)
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      disabled: {
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      required: {
        type: Boolean,
        coerce: coerceBoolean,
        default: null
      },
      placeholder: {
        type: String,
        default: null
      },
      limit: {
        type: Number,
        default: 1024
      },
      name: {
        type: String,
        default: null
      },
      searchText: {
        type: String,
        default: null
      },
      showResetButton: {
        type: Boolean,
        default: false
      },
      closeOnSelect: { // only works when multiple
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      lang: {
        type: String,
        default: navigator.language
      },
      justified: {
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      url: {
        type: String,
        default: null
      },
      cache: { //save old data -- not working yet (experimental)
        type: Array,
        default: true
      },
      parent: {
        twoWay: true,
        type: Array,
        default: true
      }
    },
    ready() {
      if (this.value instanceof Array) {
        if (!this.multiple && this.value.length > 1) {
          this.value = this.value.slice(0, 1)
        } else if (this.multiple && this.value.length > this.limit) {
          this.value = this.value.slice(0, this.limit)
        }
      } else {
        if (this.value === null || this.value === undefined || this.value.length === 0) {
          this.value = []
        } else {
          this.value = [this.value]
        }
      }
      if (this.url && !this.options.length) this.update()
    },
    data() {
      return {
        ajax: null,
        searchValue: null,
        show: false,
        showNotify: false
      }
    },
    computed: {
      selectedItems() {
        let foundItems = []
        if (this.value.length) {
          for (var item of this.value) {
            if (this.options.length ===0) {
              foundItems = this.value;
            } else {
              if (~['number','string'].indexOf(typeof item)) {
                let option
                this.options.some(o => {
                  if(o.value == item) {
                    option = o
                    return true
                  }
                })
                option && foundItems.push(option.label)
              }
            }
          }
          return foundItems.join(', ')
        }
      },
      limitText() {
        return this.text.limit.replace('{{limit}}', this.limit)
      },
      showPlaceholder() {
        return this.value.length === 0
      },
      text() {
        return translations(this.lang)
      },
      hasParent() {
        return this.url && (this.parent === true || (this.parent instanceof Array && this.parent.length))
      }
    },
    watch: {
      value(val) {
        if (val.length > this.limit) {
          this.showNotify = true
          this.value.pop()
          setTimeout(() => this.showNotify = false, 1000)
        }
      },
      show(val) {
        if (this.show) this.focus()
      },
      url(val,old) {
        this.update()
      },
      parent(val,old) {
        this.value = []
        this.update()
      }
    },
    methods: {
      select(v) {
          if (~this.value.indexOf(v)) {
            if (this.multiple) {
              this.value.$remove(v)
            }
          } else {
            if (this.multiple) {
              this.value.push(v)
            } else {
              this.value = [v]
            }
          }
          if (!this.multiple || this.closeOnSelect) {
            this.toggleDropdown()
          }
      },
      clear() {
        this.value = []
        this.toggleDropdown()
      },
      isSelected(v) {
        if (this.value instanceof Array) {
          return ~this.value.indexOf(v)
        } else {
          return this.value == v
        }
      },
      toggleDropdown() {
        this.show = !this.show
        if (timeout) {
          clearTimeout(timeout)
          timeout = false
        }
      },
      blur() {
        if (this.search) {
          timeout = setTimeout(() => timeout = this.show = false, 100)
        } else {
          this.show = false
        }
      },
      focus() {
        if (this.show) {
          (this.$els.search || this.$els.btn).focus()
        } else {
          this.$els.btn.focus()
        }
      },
      update() {
        if (!this.hasParent) {
          this.options = []
          this.disabled = !this.options.length
          if (this.disabled) this.value = []
        } else {
          this.ajax = true
          callAjax(this.url, (data)=> {
            let options = []
            for (let opc of data) {
              if(opc.value !== undefined && opc.label !== undefined) options.push({value: opc.value, label: opc.label})
            }
            this.options = options
            this.disabled = !this.options.length
            if (this.disabled) this.value = []
          }).always(()=> this.ajax = false)
        }
      }
    }
  }
</script>

<style scoped>
.btn-select {
  display: inline-block;
}
.bs-searchbox {
  padding: 4px 8px;
}
.btn-group .dropdown-menu .notify {
  position: absolute;
  bottom: 5px;
  width: 96%;
  margin: 0 2%;
  min-height: 26px;
  padding: 3px 5px;
  background: #f5f5f5;
  border: 1px solid #e3e3e3;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
  pointer-events: none;
  opacity: .9;
}
.btn-group.btn-group-justified .dropdown-menu {
  width:100%;
}
span.caret {
  float: right;
  margin-top: 9px;
  margin-left: 5px;
}
span.close {
  margin-left: 5px;
}
span[select]>select {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
</style>
