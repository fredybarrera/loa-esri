(function(e, a) { for(var i in a) e[i] = a[i]; }(window, /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js":
/*!******************************************************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js ***!
  \******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * @author: Dennis Hernández
 * @webSite: http://djhvscf.github.io/Blog
 * @version: v2.2.0
 */
var Utils = $.fn.bootstrapTable.utils;
var UtilsFilterControl = {
  getOptionsFromSelectControl: function getOptionsFromSelectControl(selectControl) {
    return selectControl.get(selectControl.length - 1).options;
  },
  getControlContainer: function getControlContainer() {
    if (UtilsFilterControl.bootstrapTableInstance.options.filterControlContainer) {
      return $("".concat(UtilsFilterControl.bootstrapTableInstance.options.filterControlContainer));
    }

    return UtilsFilterControl.getCurrentHeader(UtilsFilterControl.bootstrapTableInstance);
  },
  getSearchControls: function getSearchControls(scope) {
    var header = UtilsFilterControl.getControlContainer();
    var searchControls = UtilsFilterControl.getCurrentSearchControls(scope);
    return header.find(searchControls);
  },
  hideUnusedSelectOptions: function hideUnusedSelectOptions(selectControl, uniqueValues) {
    var options = UtilsFilterControl.getOptionsFromSelectControl(selectControl);

    for (var i = 0; i < options.length; i++) {
      if (options[i].value !== '') {
        if (!uniqueValues.hasOwnProperty(options[i].value)) {
          selectControl.find(Utils.sprintf('option[value=\'%s\']', options[i].value)).hide();
        } else {
          selectControl.find(Utils.sprintf('option[value=\'%s\']', options[i].value)).show();
        }
      }
    }
  },
  addOptionToSelectControl: function addOptionToSelectControl(selectControl, _value, text, selected) {
    var value = $.trim(_value);
    var $selectControl = $(selectControl.get(selectControl.length - 1));

    if (!UtilsFilterControl.existOptionInSelectControl(selectControl, value)) {
      var option = $("<option value=\"".concat(value, "\">").concat(text, "</option>"));

      if (value === selected) {
        option.attr('selected', true);
      }

      $selectControl.append(option);
    }
  },
  sortSelectControl: function sortSelectControl(selectControl, orderBy) {
    var $selectControl = $(selectControl.get(selectControl.length - 1));
    var $opts = $selectControl.find('option:gt(0)');
    $opts.sort(function (a, b) {
      return Utils.sort(a.textContent, b.textContent, orderBy === 'desc' ? -1 : 1);
    });
    $selectControl.find('option:gt(0)').remove();
    $selectControl.append($opts);
  },
  existOptionInSelectControl: function existOptionInSelectControl(selectControl, value) {
    var options = UtilsFilterControl.getOptionsFromSelectControl(selectControl);

    for (var i = 0; i < options.length; i++) {
      if (options[i].value === value.toString()) {
        // The value is not valid to add
        return true;
      }
    } // If we get here, the value is valid to add


    return false;
  },
  fixHeaderCSS: function fixHeaderCSS(_ref) {
    var $tableHeader = _ref.$tableHeader;
    $tableHeader.css('height', '77px');
  },
  getCurrentHeader: function getCurrentHeader(_ref2) {
    var $header = _ref2.$header,
        options = _ref2.options,
        $tableHeader = _ref2.$tableHeader;
    var header = $header;

    if (options.height) {
      header = $tableHeader;
    }

    return header;
  },
  getCurrentSearchControls: function getCurrentSearchControls(_ref3) {
    var options = _ref3.options;
    var searchControls = 'select, input';

    if (options.height) {
      searchControls = 'table select, table input';
    }

    return searchControls;
  },
  getCursorPosition: function getCursorPosition(el) {
    if (Utils.isIEBrowser()) {
      if ($(el).is('input[type=text]')) {
        var pos = 0;

        if ('selectionStart' in el) {
          pos = el.selectionStart;
        } else if ('selection' in document) {
          el.focus();
          var Sel = document.selection.createRange();
          var SelLength = document.selection.createRange().text.length;
          Sel.moveStart('character', -el.value.length);
          pos = Sel.text.length - SelLength;
        }

        return pos;
      }

      return -1;
    }

    return -1;
  },
  setCursorPosition: function setCursorPosition(el) {
    $(el).val(el.value);
  },
  copyValues: function copyValues(that) {
    var searchControls = UtilsFilterControl.getSearchControls(that);
    that.options.valuesFilterControl = [];
    searchControls.each(function () {
      that.options.valuesFilterControl.push({
        field: $(this).closest('[data-field]').data('field'),
        value: $(this).val(),
        position: UtilsFilterControl.getCursorPosition($(this).get(0)),
        hasFocus: $(this).is(':focus')
      });
    });
  },
  setValues: function setValues(that) {
    var field = null;
    var result = [];
    var searchControls = UtilsFilterControl.getSearchControls(that);

    if (that.options.valuesFilterControl.length > 0) {
      //  Callback to apply after settings fields values
      var fieldToFocusCallback = null;
      searchControls.each(function (index, ele) {
        field = $(this).closest('[data-field]').data('field');
        result = that.options.valuesFilterControl.filter(function (valueObj) {
          return valueObj.field === field;
        });

        if (result.length > 0) {
          $(this).val(result[0].value);

          if (result[0].hasFocus && result[0].value !== '') {
            // set callback if the field had the focus.
            fieldToFocusCallback = function (fieldToFocus, carretPosition) {
              // Closure here to capture the field and cursor position
              var closedCallback = function closedCallback() {
                fieldToFocus.focus();
                UtilsFilterControl.setCursorPosition(fieldToFocus, carretPosition);
              };

              return closedCallback;
            }($(this).get(0), result[0].position);
          }
        }
      }); // Callback call.

      if (fieldToFocusCallback !== null) {
        fieldToFocusCallback();
      }
    }
  },
  collectBootstrapCookies: function collectBootstrapCookies() {
    var cookies = [];
    var foundCookies = document.cookie.match(/(?:bs.table.)(\w*)/g);
    var foundLocalStorage = localStorage;

    if (foundCookies) {
      $.each(foundCookies, function (i, _cookie) {
        var cookie = _cookie;

        if (/./.test(cookie)) {
          cookie = cookie.split('.').pop();
        }

        if ($.inArray(cookie, cookies) === -1) {
          cookies.push(cookie);
        }
      });
    }

    if (foundLocalStorage) {
      for (var i = 0; i < foundLocalStorage.length; i++) {
        var cookie = foundLocalStorage.key(i);

        if (/./.test(cookie)) {
          cookie = cookie.split('.').pop();
        }

        if (!cookies.includes(cookie)) {
          cookies.push(cookie);
        }
      }
    }

    return cookies;
  },
  escapeID: function escapeID(id) {
    // eslint-disable-next-line no-useless-escape
    return String(id).replace(/([:.\[\],])/g, '\\$1');
  },
  isColumnSearchableViaSelect: function isColumnSearchableViaSelect(_ref4) {
    var filterControl = _ref4.filterControl,
        searchable = _ref4.searchable;
    return filterControl && filterControl.toLowerCase() === 'select' && searchable;
  },
  isFilterDataNotGiven: function isFilterDataNotGiven(_ref5) {
    var filterData = _ref5.filterData;
    return filterData === undefined || filterData.toLowerCase() === 'column';
  },
  hasSelectControlElement: function hasSelectControlElement(selectControl) {
    return selectControl && selectControl.length > 0;
  },
  initFilterSelectControls: function initFilterSelectControls(that) {
    var data = that.data;
    var z = that.options.pagination ? that.options.sidePagination === 'server' ? that.pageTo : that.options.totalRows : that.pageTo;
    $.each(that.header.fields, function (j, field) {
      var column = that.columns[that.fieldsColumnsIndex[field]];
      var selectControl = UtilsFilterControl.getControlContainer().find(".bootstrap-table-filter-control-".concat(UtilsFilterControl.escapeID(column.field)));

      if (UtilsFilterControl.isColumnSearchableViaSelect(column) && UtilsFilterControl.isFilterDataNotGiven(column) && UtilsFilterControl.hasSelectControlElement(selectControl)) {
        if (selectControl.get(selectControl.length - 1).options.length === 0) {
          // Added the default option
          UtilsFilterControl.addOptionToSelectControl(selectControl, '', column.filterControlPlaceholder, column.filterDefault);
        }

        var uniqueValues = {};

        for (var i = 0; i < z; i++) {
          // Added a new value
          var fieldValue = data[i][field];
          var formatter = that.options.editable && column.editable ? column._formatter : that.header.formatters[j];
          var formattedValue = Utils.calculateObjectValue(that.header, formatter, [fieldValue, data[i], i], fieldValue);

          if (column.filterDataCollector) {
            formattedValue = Utils.calculateObjectValue(that.header, column.filterDataCollector, [fieldValue, data[i], formattedValue], formattedValue);
          }

          uniqueValues[formattedValue] = fieldValue;

          if (_typeof(formattedValue) === 'object' && formattedValue !== null) {
            formattedValue.forEach(function (value) {
              UtilsFilterControl.addOptionToSelectControl(selectControl, value, value, column.filterDefault);
            });
            continue;
          }

          UtilsFilterControl.addOptionToSelectControl(selectControl, formattedValue, formattedValue, column.filterDefault);
        }

        UtilsFilterControl.sortSelectControl(selectControl, column.filterOrderBy);

        if (that.options.hideUnusedSelectOptions) {
          UtilsFilterControl.hideUnusedSelectOptions(selectControl, uniqueValues);
        }
      }
    });
    that.trigger('created-controls');
  },
  getFilterDataMethod: function getFilterDataMethod(objFilterDataMethod, searchTerm) {
    var keys = Object.keys(objFilterDataMethod);

    for (var i = 0; i < keys.length; i++) {
      if (keys[i] === searchTerm) {
        return objFilterDataMethod[searchTerm];
      }
    }

    return null;
  },
  createControls: function createControls(that, header) {
    var addedFilterControl = false;
    var isVisible;
    var html;
    $.each(that.columns, function (i, column) {
      html = [];

      if (!column.visible) {
        return;
      }

      if (!column.filterControl && !that.options.filterControlContainer) {
        html.push('<div class="no-filter-control"></div>');
      } else if (that.options.filterControlContainer) {
        var $filterControl = $(".bootstrap-table-filter-control-".concat(column.field));
        var placeholder = column.filterControlPlaceholder ? column.filterControlPlaceholder : '';
        $filterControl.attr('placeholder', placeholder);
        $filterControl.val(column.filterDefault);
        $filterControl.attr('data-field', column.field);
        addedFilterControl = true;
      } else {
        var nameControl = column.filterControl.toLowerCase();
        html.push('<div class="filter-control">');
        addedFilterControl = true;

        if (column.searchable && that.options.filterTemplate[nameControl]) {
          html.push(that.options.filterTemplate[nameControl](that, column.field, column.filterControlPlaceholder ? column.filterControlPlaceholder : '', column.filterDefault));
        }
      }

      if (!column.filterControl && '' !== column.filterDefault && 'undefined' !== typeof column.filterDefault) {
        if ($.isEmptyObject(that.filterColumnsPartial)) {
          that.filterColumnsPartial = {};
        }

        that.filterColumnsPartial[column.field] = column.filterDefault;
      }

      $.each(header.children().children(), function (i, tr) {
        var $tr = $(tr);

        if ($tr.data('field') === column.field) {
          $tr.find('.fht-cell').append(html.join(''));
          return false;
        }
      });

      if (column.filterData !== undefined && column.filterData.toLowerCase() !== 'column') {
        var filterDataType = UtilsFilterControl.getFilterDataMethod(
        /* eslint-disable no-use-before-define */
        filterDataMethods, column.filterData.substring(0, column.filterData.indexOf(':')));
        var filterDataSource;
        var selectControl;

        if (filterDataType !== null) {
          filterDataSource = column.filterData.substring(column.filterData.indexOf(':') + 1, column.filterData.length);
          selectControl = UtilsFilterControl.getControlContainer().find(".bootstrap-table-filter-control-".concat(UtilsFilterControl.escapeID(column.field)));
          UtilsFilterControl.addOptionToSelectControl(selectControl, '', column.filterControlPlaceholder, column.filterDefault);
          filterDataType(filterDataSource, selectControl, that.options.filterOrderBy, column.filterDefault);
        } else {
          throw new SyntaxError('Error. You should use any of these allowed filter data methods: var, obj, json, url, func.' + ' Use like this: var: {key: "value"}');
        }
      }
    });

    if (addedFilterControl) {
      UtilsFilterControl.getControlContainer().off('keyup', 'input').on('keyup', 'input', function (_ref6, obj) {
        var currentTarget = _ref6.currentTarget,
            keyCode = _ref6.keyCode;
        // Simulate enter key action from clear button
        keyCode = obj ? obj.keyCode : keyCode;

        if (that.options.searchOnEnterKey && keyCode !== 13) {
          return;
        }

        if ($.inArray(keyCode, [37, 38, 39, 40]) > -1) {
          return;
        }

        var $currentTarget = $(currentTarget);

        if ($currentTarget.is(':checkbox') || $currentTarget.is(':radio')) {
          return;
        }

        clearTimeout(currentTarget.timeoutId || 0);
        currentTarget.timeoutId = setTimeout(function () {
          that.onColumnSearch({
            currentTarget: currentTarget,
            keyCode: keyCode
          });
        }, that.options.searchTimeOut);
      });
      UtilsFilterControl.getControlContainer().off('change', 'select').on('change', 'select', function (_ref7) {
        var currentTarget = _ref7.currentTarget,
            keyCode = _ref7.keyCode;

        if (that.options.searchOnEnterKey && keyCode !== 13) {
          return;
        }

        if ($.inArray(keyCode, [37, 38, 39, 40]) > -1) {
          return;
        }

        var $select = $(currentTarget);
        var value = $select.val();

        if ($.trim(value)) {
          $select.find('option[selected]').removeAttr('selected');
          $select.find('option[value="' + value + '"]').attr('selected', true);
        } else {
          $select.find('option[selected]').removeAttr('selected');
        }

        clearTimeout(currentTarget.timeoutId || 0);
        currentTarget.timeoutId = setTimeout(function () {
          that.onColumnSearch({
            currentTarget: currentTarget,
            keyCode: keyCode
          });
        }, that.options.searchTimeOut);
      });
      header.off('mouseup', 'input').on('mouseup', 'input', function (_ref8) {
        var currentTarget = _ref8.currentTarget,
            keyCode = _ref8.keyCode;
        var $input = $(currentTarget);
        var oldValue = $input.val();

        if (oldValue === '') {
          return;
        }

        setTimeout(function () {
          var newValue = $input.val();

          if (newValue === '') {
            clearTimeout(currentTarget.timeoutId || 0);
            currentTarget.timeoutId = setTimeout(function () {
              that.onColumnSearch({
                currentTarget: currentTarget,
                keyCode: keyCode
              });
            }, that.options.searchTimeOut);
          }
        }, 1);
      });

      if (UtilsFilterControl.getControlContainer().find('.date-filter-control').length > 0) {
        $.each(that.columns, function (i, _ref9) {
          var filterControl = _ref9.filterControl,
              field = _ref9.field,
              filterDatepickerOptions = _ref9.filterDatepickerOptions;

          if (filterControl !== undefined && filterControl.toLowerCase() === 'datepicker') {
            UtilsFilterControl.getControlContainer().find(".date-filter-control.bootstrap-table-filter-control-".concat(field)).datepicker(filterDatepickerOptions).on('changeDate', function (_ref10) {
              var currentTarget = _ref10.currentTarget,
                  keyCode = _ref10.keyCode;
              clearTimeout(currentTarget.timeoutId || 0);
              currentTarget.timeoutId = setTimeout(function () {
                that.onColumnSearch({
                  currentTarget: currentTarget,
                  keyCode: keyCode
                });
              }, that.options.searchTimeOut);
            });
          }
        });
      }

      if (that.options.sidePagination !== 'server') {
        that.triggerSearch();
      }
    } else {
      UtilsFilterControl.getControlContainer().find('.filterControl').hide();
    }
  },
  getDirectionOfSelectOptions: function getDirectionOfSelectOptions(_alignment) {
    var alignment = _alignment === undefined ? 'left' : _alignment.toLowerCase();

    switch (alignment) {
      case 'left':
        return 'ltr';

      case 'right':
        return 'rtl';

      case 'auto':
        return 'auto';

      default:
        return 'ltr';
    }
  }
};
var filterDataMethods = {
  func: function func(filterDataSource, selectControl, filterOrderBy, selected) {
    var variableValues = window[filterDataSource].apply();

    for (var key in variableValues) {
      UtilsFilterControl.addOptionToSelectControl(selectControl, key, variableValues[key], selected);
    }

    UtilsFilterControl.sortSelectControl(selectControl, filterOrderBy);
  },
  obj: function obj(filterDataSource, selectControl, filterOrderBy, selected) {
    var objectKeys = filterDataSource.split('.');
    var variableName = objectKeys.shift();
    var variableValues = window[variableName];

    if (objectKeys.length > 0) {
      objectKeys.forEach(function (key) {
        variableValues = variableValues[key];
      });
    }

    for (var key in variableValues) {
      UtilsFilterControl.addOptionToSelectControl(selectControl, key, variableValues[key], selected);
    }

    UtilsFilterControl.sortSelectControl(selectControl, filterOrderBy);
  },
  var: function _var(filterDataSource, selectControl, filterOrderBy, selected) {
    var variableValues = window[filterDataSource];

    for (var key in variableValues) {
      UtilsFilterControl.addOptionToSelectControl(selectControl, key, variableValues[key], selected);
    }

    UtilsFilterControl.sortSelectControl(selectControl, filterOrderBy);
  },
  url: function url(filterDataSource, selectControl, filterOrderBy, selected) {
    $.ajax({
      url: filterDataSource,
      dataType: 'json',
      success: function success(data) {
        for (var key in data) {
          UtilsFilterControl.addOptionToSelectControl(selectControl, key, data[key], selected);
        }

        UtilsFilterControl.sortSelectControl(selectControl, filterOrderBy);
      }
    });
  },
  json: function json(filterDataSource, selectControl, filterOrderBy, selected) {
    var variableValues = JSON.parse(filterDataSource);

    for (var key in variableValues) {
      UtilsFilterControl.addOptionToSelectControl(selectControl, key, variableValues[key], selected);
    }

    UtilsFilterControl.sortSelectControl(selectControl, filterOrderBy);
  }
};
$.extend($.fn.bootstrapTable.defaults, {
  filterControl: false,
  onColumnSearch: function onColumnSearch(field, text) {
    return false;
  },
  onCreatedControls: function onCreatedControls() {
    return true;
  },
  alignmentSelectControlOptions: undefined,
  filterTemplate: {
    input: function input(that, field, placeholder, value) {
      return Utils.sprintf('<input type="text" class="form-control bootstrap-table-filter-control-%s search-input" style="width: 100%;" placeholder="%s" value="%s">', field, 'undefined' === typeof placeholder ? '' : placeholder, 'undefined' === typeof value ? '' : value);
    },
    select: function select(_ref11, field) {
      var options = _ref11.options;
      return Utils.sprintf('<select class="form-control bootstrap-table-filter-control-%s" style="width: 100%;" dir="%s"></select>', field, UtilsFilterControl.getDirectionOfSelectOptions(options.alignmentSelectControlOptions));
    },
    datepicker: function datepicker(that, field, value) {
      return Utils.sprintf('<input type="text" class="form-control date-filter-control bootstrap-table-filter-control-%s" style="width: 100%;" value="%s">', field, 'undefined' === typeof value ? '' : value);
    }
  },
  disableControlWhenSearch: false,
  searchOnEnterKey: false,
  // internal variables
  valuesFilterControl: []
});
$.extend($.fn.bootstrapTable.columnDefaults, {
  filterControl: undefined,
  filterDataCollector: undefined,
  filterData: undefined,
  filterDatepickerOptions: undefined,
  filterStrictSearch: false,
  filterStartsWithSearch: false,
  filterControlPlaceholder: '',
  filterDefault: '',
  filterOrderBy: 'asc' // asc || desc

});
$.extend($.fn.bootstrapTable.Constructor.EVENTS, {
  'column-search.bs.table': 'onColumnSearch',
  'created-controls.bs.table': 'onCreatedControls'
});
$.extend($.fn.bootstrapTable.defaults.icons, {
  clear: {
    bootstrap3: 'glyphicon-trash icon-clear'
  }[$.fn.bootstrapTable.theme] || 'fa-trash'
});
$.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales);
$.extend($.fn.bootstrapTable.defaults, {
  formatClearSearch: function formatClearSearch() {
    return 'Clear filters';
  }
});
$.fn.bootstrapTable.methods.push('triggerSearch');
$.fn.bootstrapTable.methods.push('clearFilterControl');

$.BootstrapTable = /*#__PURE__*/function (_$$BootstrapTable) {
  _inherits(_class, _$$BootstrapTable);

  var _super = _createSuper(_class);

  function _class() {
    _classCallCheck(this, _class);

    return _super.apply(this, arguments);
  }

  _createClass(_class, [{
    key: "init",
    value: function init() {
      var _this = this;

      UtilsFilterControl.bootstrapTableInstance = this; // Make sure that the filterControl option is set

      if (this.options.filterControl) {
        var that = this; // Make sure that the internal variables are set correctly

        this.options.valuesFilterControl = [];
        this.$el.on('reset-view.bs.table', function () {
          // Create controls on $tableHeader if the height is set
          if (!that.options.height) {
            return;
          } // Avoid recreate the controls


          if (UtilsFilterControl.getControlContainer().find('select').length > 0 || UtilsFilterControl.getControlContainer().find('input').length > 0) {
            return;
          }

          UtilsFilterControl.createControls(that, UtilsFilterControl.getControlContainer());
        }).on('post-header.bs.table', function () {
          UtilsFilterControl.setValues(that);
        }).on('post-body.bs.table', function () {
          if (that.options.height && !that.options.filterControlContainer) {
            UtilsFilterControl.fixHeaderCSS(that);
          }

          _this.$tableLoading.css('top', _this.$header.outerHeight() + 1);
        }).on('column-switch.bs.table', function () {
          UtilsFilterControl.setValues(that);
        }).on('load-success.bs.table', function () {
          that.enableControls(true);
        }).on('load-error.bs.table', function () {
          that.enableControls(true);
        });
      }

      _get(_getPrototypeOf(_class.prototype), "init", this).call(this);
    }
  }, {
    key: "initHeader",
    value: function initHeader() {
      _get(_getPrototypeOf(_class.prototype), "initHeader", this).call(this);

      if (!this.options.filterControl) {
        return;
      }

      UtilsFilterControl.createControls(this, UtilsFilterControl.getControlContainer());
    }
  }, {
    key: "initBody",
    value: function initBody() {
      _get(_getPrototypeOf(_class.prototype), "initBody", this).call(this);

      UtilsFilterControl.initFilterSelectControls(this);
    }
  }, {
    key: "initSearch",
    value: function initSearch() {
      var that = this;
      var fp = $.isEmptyObject(that.filterColumnsPartial) ? null : that.filterColumnsPartial;

      if (fp === null || Object.keys(fp).length <= 1) {
        _get(_getPrototypeOf(_class.prototype), "initSearch", this).call(this);
      }

      if (this.options.sidePagination === 'server') {
        return;
      }

      if (fp === null) {
        return;
      } // Check partial column filter


      that.data = fp ? that.options.data.filter(function (item, i) {
        var itemIsExpected = [];
        var keys1 = Object.keys(item);
        var keys2 = Object.keys(fp);
        var keys = keys1.concat(keys2.filter(function (item) {
          return !keys1.includes(item);
        }));
        keys.forEach(function (key) {
          var thisColumn = that.columns[that.fieldsColumnsIndex[key]];
          var fval = (fp[key] || '').toLowerCase();
          var value = Utils.getItemField(item, key, false);
          var tmpItemIsExpected;

          if (fval === '') {
            tmpItemIsExpected = true;
          } else {
            // Fix #142: search use formatted data
            if (thisColumn && thisColumn.searchFormatter) {
              value = $.fn.bootstrapTable.utils.calculateObjectValue(that.header, that.header.formatters[$.inArray(key, that.header.fields)], [value, item, i], value);
            }

            if ($.inArray(key, that.header.fields) !== -1) {
              if (value === undefined || value === null) {
                tmpItemIsExpected = false;
              } else if (typeof value === 'string' || typeof value === 'number' || typeof value === 'boolean') {
                if (thisColumn.filterStrictSearch) {
                  tmpItemIsExpected = value.toString().toLowerCase() === fval.toString().toLowerCase();
                } else if (thisColumn.filterStartsWithSearch) {
                  tmpItemIsExpected = "".concat(value).toLowerCase().indexOf(fval) === 0;
                } else {
                  tmpItemIsExpected = "".concat(value).toLowerCase().includes(fval);
                }

                var largerSmallerEqualsRegex = /(?:(<=|=>|=<|>=|>|<)(?:\s+)?(\d+)?|(\d+)?(\s+)?(<=|=>|=<|>=|>|<))/gm;
                var matches = largerSmallerEqualsRegex.exec(fval);

                if (matches) {
                  var operator = matches[1] || "".concat(matches[5], "l");
                  var comparisonValue = matches[2] || matches[3];
                  var int = parseInt(value, 10);
                  var comparisonInt = parseInt(comparisonValue, 10);

                  switch (operator) {
                    case '>':
                    case '<l':
                      tmpItemIsExpected = int > comparisonInt;
                      break;

                    case '<':
                    case '>l':
                      tmpItemIsExpected = int < comparisonInt;
                      break;

                    case '<=':
                    case '=<':
                    case '>=l':
                    case '=>l':
                      tmpItemIsExpected = int <= comparisonInt;
                      break;

                    case '>=':
                    case '=>':
                    case '<=l':
                    case '=<l':
                      tmpItemIsExpected = int >= comparisonInt;
                      break;

                    default:
                      break;
                  }
                }

                if (thisColumn.filterCustomSearch) {
                  var customSearchResult = Utils.calculateObjectValue(that, thisColumn.filterCustomSearch, [fval, value, key, that.options.data], true);

                  if (customSearchResult !== null) {
                    tmpItemIsExpected = customSearchResult;
                  }
                }
              }
            }
          }

          itemIsExpected.push(tmpItemIsExpected);
        });
        return !itemIsExpected.includes(false);
      }) : that.data;
    }
  }, {
    key: "initColumnSearch",
    value: function initColumnSearch(filterColumnsDefaults) {
      UtilsFilterControl.copyValues(this);

      if (filterColumnsDefaults) {
        this.filterColumnsPartial = filterColumnsDefaults;
        this.updatePagination();

        for (var filter in filterColumnsDefaults) {
          this.trigger('column-search', filter, filterColumnsDefaults[filter]);
        }
      }
    }
  }, {
    key: "onColumnSearch",
    value: function onColumnSearch(_ref12) {
      var currentTarget = _ref12.currentTarget,
          keyCode = _ref12.keyCode;

      if ($.inArray(keyCode, [37, 38, 39, 40]) > -1) {
        return;
      }

      UtilsFilterControl.copyValues(this);
      var text = $.trim($(currentTarget).val());
      var $field = $(currentTarget).closest('[data-field]').data('field');

      if ($.isEmptyObject(this.filterColumnsPartial)) {
        this.filterColumnsPartial = {};
      }

      if (text) {
        this.filterColumnsPartial[$field] = text;
      } else {
        delete this.filterColumnsPartial[$field];
      }

      this.options.pageNumber = 1;
      this.enableControls(false);
      this.onSearch({
        currentTarget: currentTarget
      }, false);
      this.trigger('column-search', $field, text);
    }
  }, {
    key: "initToolbar",
    value: function initToolbar() {
      this.showSearchClearButton = this.options.filterControl && this.options.showSearchClearButton;

      _get(_getPrototypeOf(_class.prototype), "initToolbar", this).call(this);
    }
  }, {
    key: "resetSearch",
    value: function resetSearch(text) {
      if (this.options.filterControl && this.options.showSearchClearButton) {
        this.clearFilterControl();
      }

      _get(_getPrototypeOf(_class.prototype), "resetSearch", this).call(this, text);
    }
  }, {
    key: "clearFilterControl",
    value: function clearFilterControl() {
      if (this.options.filterControl) {
        var that = this;
        var cookies = UtilsFilterControl.collectBootstrapCookies();
        var header = UtilsFilterControl.getCurrentHeader(that);
        var table = header.closest('table');
        var controls = header.find(UtilsFilterControl.getCurrentSearchControls(that));
        var search = that.$toolbar.find('.search input');
        var hasValues = false;
        var timeoutId = 0;
        $.each(that.options.valuesFilterControl, function (i, item) {
          hasValues = hasValues ? true : item.value !== '';
          item.value = '';
        });
        $.each(that.options.filterControls, function (i, item) {
          item.text = '';
        });
        UtilsFilterControl.setValues(that); // clear cookies once the filters are clean

        clearTimeout(timeoutId);
        timeoutId = setTimeout(function () {
          if (cookies && cookies.length > 0) {
            $.each(cookies, function (i, item) {
              if (that.deleteCookie !== undefined) {
                that.deleteCookie(item);
              }
            });
          }
        }, that.options.searchTimeOut); // If there is not any value in the controls exit this method

        if (!hasValues) {
          return;
        } // Clear each type of filter if it exists.
        // Requires the body to reload each time a type of filter is found because we never know
        // which ones are going to be present.


        if (controls.length > 0) {
          this.filterColumnsPartial = {};
          $(controls[0]).trigger(controls[0].tagName === 'INPUT' ? 'keyup' : 'change', {
            keyCode: 13
          });
        } else {
          return;
        }

        if (search.length > 0) {
          that.resetSearch();
        } // use the default sort order if it exists. do nothing if it does not


        if (that.options.sortName !== table.data('sortName') || that.options.sortOrder !== table.data('sortOrder')) {
          var sorter = header.find(Utils.sprintf('[data-field="%s"]', $(controls[0]).closest('table').data('sortName')));

          if (sorter.length > 0) {
            that.onSort({
              type: 'keypress',
              currentTarget: sorter
            });
            $(sorter).find('.sortable').trigger('click');
          }
        }
      }
    }
  }, {
    key: "triggerSearch",
    value: function triggerSearch() {
      var searchControls = UtilsFilterControl.getSearchControls(this);
      searchControls.each(function () {
        var el = $(this);

        if (el.is('select')) {
          el.change();
        } else {
          el.keyup();
        }
      });
    }
  }, {
    key: "enableControls",
    value: function enableControls(enable) {
      if (this.options.disableControlWhenSearch && this.options.sidePagination === 'server') {
        var searchControls = UtilsFilterControl.getSearchControls(this);

        if (!enable) {
          searchControls.prop('disabled', 'disabled');
        } else {
          searchControls.removeProp('disabled');
        }
      }
    }
  }]);

  return _class;
}($.BootstrapTable);

/***/ }),

/***/ "./resources/assets/vendor/libs/bootstrap-table/extensions/filter-control/filter-control.js":
/*!**************************************************************************************************!*\
  !*** ./resources/assets/vendor/libs/bootstrap-table/extensions/filter-control/filter-control.js ***!
  \**************************************************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bootstrap_table_src_extensions_filter_control_bootstrap_table_filter_control_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js */ "./node_modules/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js");
/* harmony import */ var bootstrap_table_src_extensions_filter_control_bootstrap_table_filter_control_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(bootstrap_table_src_extensions_filter_control_bootstrap_table_filter_control_js__WEBPACK_IMPORTED_MODULE_0__);


/***/ }),

/***/ 40:
/*!********************************************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/bootstrap-table/extensions/filter-control/filter-control.js ***!
  \********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\loa-esri\resources\assets\vendor\libs\bootstrap-table\extensions\filter-control\filter-control.js */"./resources/assets/vendor/libs/bootstrap-table/extensions/filter-control/filter-control.js");


/***/ })

/******/ })));