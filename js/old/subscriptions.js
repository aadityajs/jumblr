//     Underscore.js 1.1.4
//     (c) 2011 Jeremy Ashkenas, DocumentCloud Inc.
//     Underscore is freely distributable under the MIT license.
//     Portions of Underscore are inspired or borrowed from Prototype,
//     Oliver Steele's Functional, and John Resig's Micro-Templating.
//     For all details and documentation:
//     http://documentcloud.github.com/underscore

(function() {

  // Baseline setup
  // --------------

  // Establish the root object, `window` in the browser, or `global` on the server.
  var root = this;

  // Save the previous value of the `_` variable.
  var previousUnderscore = root._;

  // Establish the object that gets returned to break out of a loop iteration.
  var breaker = {};

  // Save bytes in the minified (but not gzipped) version:
  var ArrayProto = Array.prototype, ObjProto = Object.prototype;

  // Create quick reference variables for speed access to core prototypes.
  var slice            = ArrayProto.slice,
      unshift          = ArrayProto.unshift,
      toString         = ObjProto.toString,
      hasOwnProperty   = ObjProto.hasOwnProperty;

  // All **ECMAScript 5** native function implementations that we hope to use
  // are declared here.
  var
    nativeForEach      = ArrayProto.forEach,
    nativeMap          = ArrayProto.map,
    nativeReduce       = ArrayProto.reduce,
    nativeReduceRight  = ArrayProto.reduceRight,
    nativeFilter       = ArrayProto.filter,
    nativeEvery        = ArrayProto.every,
    nativeSome         = ArrayProto.some,
    nativeIndexOf      = ArrayProto.indexOf,
    nativeLastIndexOf  = ArrayProto.lastIndexOf,
    nativeIsArray      = Array.isArray,
    nativeKeys         = Object.keys;

  // Create a safe reference to the Underscore object for use below.
  var _ = function(obj) { return new wrapper(obj); };

  // Export the Underscore object for **CommonJS**, with backwards-compatibility
  // for the old `require()` API. If we're not in CommonJS, add `_` to the
  // global object.
  if (typeof module !== 'undefined' && module.exports) {
    module.exports = _;
    _._ = _;
  } else {
    root._ = _;
  }

  // Current version.
  _.VERSION = '1.1.4';

  // Collection Functions
  // --------------------

  // The cornerstone, an `each` implementation, aka `forEach`.
  // Handles objects implementing `forEach`, arrays, and raw objects.
  // Delegates to **ECMAScript 5**'s native `forEach` if available.
  var each = _.each = _.forEach = function(obj, iterator, context) {
    var value;
    if (obj == null) return;
    if (nativeForEach && obj.forEach === nativeForEach) {
      obj.forEach(iterator, context);
    } else if (_.isNumber(obj.length)) {
      for (var i = 0, l = obj.length; i < l; i++) {
        if (iterator.call(context, obj[i], i, obj) === breaker) return;
      }
    } else {
      for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) {
          if (iterator.call(context, obj[key], key, obj) === breaker) return;
        }
      }
    }
  };

  // Return the results of applying the iterator to each element.
  // Delegates to **ECMAScript 5**'s native `map` if available.
  _.map = function(obj, iterator, context) {
    var results = [];
    if (obj == null) return results;
    if (nativeMap && obj.map === nativeMap) return obj.map(iterator, context);
    each(obj, function(value, index, list) {
      results[results.length] = iterator.call(context, value, index, list);
    });
    return results;
  };

  // **Reduce** builds up a single result from a list of values, aka `inject`,
  // or `foldl`. Delegates to **ECMAScript 5**'s native `reduce` if available.
  _.reduce = _.foldl = _.inject = function(obj, iterator, memo, context) {
    var initial = memo !== void 0;
    if (obj == null) obj = [];
    if (nativeReduce && obj.reduce === nativeReduce) {
      if (context) iterator = _.bind(iterator, context);
      return initial ? obj.reduce(iterator, memo) : obj.reduce(iterator);
    }
    each(obj, function(value, index, list) {
      if (!initial && index === 0) {
        memo = value;
        initial = true;
      } else {
        memo = iterator.call(context, memo, value, index, list);
      }
    });
    if (!initial) throw new TypeError("Reduce of empty array with no initial value");
    return memo;
  };

  // The right-associative version of reduce, also known as `foldr`.
  // Delegates to **ECMAScript 5**'s native `reduceRight` if available.
  _.reduceRight = _.foldr = function(obj, iterator, memo, context) {
    if (obj == null) obj = [];
    if (nativeReduceRight && obj.reduceRight === nativeReduceRight) {
      if (context) iterator = _.bind(iterator, context);
      return memo !== void 0 ? obj.reduceRight(iterator, memo) : obj.reduceRight(iterator);
    }
    var reversed = (_.isArray(obj) ? obj.slice() : _.toArray(obj)).reverse();
    return _.reduce(reversed, iterator, memo, context);
  };

  // Return the first value which passes a truth test. Aliased as `detect`.
  _.find = _.detect = function(obj, iterator, context) {
    var result;
    any(obj, function(value, index, list) {
      if (iterator.call(context, value, index, list)) {
        result = value;
        return true;
      }
    });
    return result;
  };

  // Return all the elements that pass a truth test.
  // Delegates to **ECMAScript 5**'s native `filter` if available.
  // Aliased as `select`.
  _.filter = _.select = function(obj, iterator, context) {
    var results = [];
    if (obj == null) return results;
    if (nativeFilter && obj.filter === nativeFilter) return obj.filter(iterator, context);
    each(obj, function(value, index, list) {
      if (iterator.call(context, value, index, list)) results[results.length] = value;
    });
    return results;
  };

  // Return all the elements for which a truth test fails.
  _.reject = function(obj, iterator, context) {
    var results = [];
    if (obj == null) return results;
    each(obj, function(value, index, list) {
      if (!iterator.call(context, value, index, list)) results[results.length] = value;
    });
    return results;
  };

  // Determine whether all of the elements match a truth test.
  // Delegates to **ECMAScript 5**'s native `every` if available.
  // Aliased as `all`.
  _.every = _.all = function(obj, iterator, context) {
    iterator = iterator || _.identity;
    var result = true;
    if (obj == null) return result;
    if (nativeEvery && obj.every === nativeEvery) return obj.every(iterator, context);
    each(obj, function(value, index, list) {
      if (!(result = result && iterator.call(context, value, index, list))) return breaker;
    });
    return result;
  };

  // Determine if at least one element in the object matches a truth test.
  // Delegates to **ECMAScript 5**'s native `some` if available.
  // Aliased as `any`.
  var any = _.some = _.any = function(obj, iterator, context) {
    iterator = iterator || _.identity;
    var result = false;
    if (obj == null) return result;
    if (nativeSome && obj.some === nativeSome) return obj.some(iterator, context);
    each(obj, function(value, index, list) {
      if (result = iterator.call(context, value, index, list)) return breaker;
    });
    return result;
  };

  // Determine if a given value is included in the array or object using `===`.
  // Aliased as `contains`.
  _.include = _.contains = function(obj, target) {
    var found = false;
    if (obj == null) return found;
    if (nativeIndexOf && obj.indexOf === nativeIndexOf) return obj.indexOf(target) != -1;
    any(obj, function(value) {
      if (found = value === target) return true;
    });
    return found;
  };

  // Invoke a method (with arguments) on every item in a collection.
  _.invoke = function(obj, method) {
    var args = slice.call(arguments, 2);
    return _.map(obj, function(value) {
      return (method ? value[method] : value).apply(value, args);
    });
  };

  // Convenience version of a common use case of `map`: fetching a property.
  _.pluck = function(obj, key) {
    return _.map(obj, function(value){ return value[key]; });
  };

  // Return the maximum element or (element-based computation).
  _.max = function(obj, iterator, context) {
    if (!iterator && _.isArray(obj)) return Math.max.apply(Math, obj);
    var result = {computed : -Infinity};
    each(obj, function(value, index, list) {
      var computed = iterator ? iterator.call(context, value, index, list) : value;
      computed >= result.computed && (result = {value : value, computed : computed});
    });
    return result.value;
  };

  // Return the minimum element (or element-based computation).
  _.min = function(obj, iterator, context) {
    if (!iterator && _.isArray(obj)) return Math.min.apply(Math, obj);
    var result = {computed : Infinity};
    each(obj, function(value, index, list) {
      var computed = iterator ? iterator.call(context, value, index, list) : value;
      computed < result.computed && (result = {value : value, computed : computed});
    });
    return result.value;
  };

  // Sort the object's values by a criterion produced by an iterator.
  _.sortBy = function(obj, iterator, context) {
    return _.pluck(_.map(obj, function(value, index, list) {
      return {
        value : value,
        criteria : iterator.call(context, value, index, list)
      };
    }).sort(function(left, right) {
      var a = left.criteria, b = right.criteria;
      return a < b ? -1 : a > b ? 1 : 0;
    }), 'value');
  };

  // Use a comparator function to figure out at what index an object should
  // be inserted so as to maintain order. Uses binary search.
  _.sortedIndex = function(array, obj, iterator) {
    iterator = iterator || _.identity;
    var low = 0, high = array.length;
    while (low < high) {
      var mid = (low + high) >> 1;
      iterator(array[mid]) < iterator(obj) ? low = mid + 1 : high = mid;
    }
    return low;
  };

  // Safely convert anything iterable into a real, live array.
  _.toArray = function(iterable) {
    if (!iterable)                return [];
    if (iterable.toArray)         return iterable.toArray();
    if (_.isArray(iterable))      return iterable;
    if (_.isArguments(iterable))  return slice.call(iterable);
    return _.values(iterable);
  };

  // Return the number of elements in an object.
  _.size = function(obj) {
    return _.toArray(obj).length;
  };

  // Array Functions
  // ---------------

  // Get the first element of an array. Passing **n** will return the first N
  // values in the array. Aliased as `head`. The **guard** check allows it to work
  // with `_.map`.
  _.first = _.head = function(array, n, guard) {
    return n && !guard ? slice.call(array, 0, n) : array[0];
  };

  // Returns everything but the first entry of the array. Aliased as `tail`.
  // Especially useful on the arguments object. Passing an **index** will return
  // the rest of the values in the array from that index onward. The **guard**
  // check allows it to work with `_.map`.
  _.rest = _.tail = function(array, index, guard) {
    return slice.call(array, _.isUndefined(index) || guard ? 1 : index);
  };

  // Get the last element of an array.
  _.last = function(array) {
    return array[array.length - 1];
  };

  // Trim out all falsy values from an array.
  _.compact = function(array) {
    return _.filter(array, function(value){ return !!value; });
  };

  // Return a completely flattened version of an array.
  _.flatten = function(array) {
    return _.reduce(array, function(memo, value) {
      if (_.isArray(value)) return memo.concat(_.flatten(value));
      memo[memo.length] = value;
      return memo;
    }, []);
  };

  // Return a version of the array that does not contain the specified value(s).
  _.without = function(array) {
    var values = slice.call(arguments, 1);
    return _.filter(array, function(value){ return !_.include(values, value); });
  };

  // Produce a duplicate-free version of the array. If the array has already
  // been sorted, you have the option of using a faster algorithm.
  // Aliased as `unique`.
  _.uniq = _.unique = function(array, isSorted) {
    return _.reduce(array, function(memo, el, i) {
      if (0 == i || (isSorted === true ? _.last(memo) != el : !_.include(memo, el))) memo[memo.length] = el;
      return memo;
    }, []);
  };

  // Produce an array that contains every item shared between all the
  // passed-in arrays.
  _.intersect = function(array) {
    var rest = slice.call(arguments, 1);
    return _.filter(_.uniq(array), function(item) {
      return _.every(rest, function(other) {
        return _.indexOf(other, item) >= 0;
      });
    });
  };

  // Zip together multiple lists into a single array -- elements that share
  // an index go together.
  _.zip = function() {
    var args = slice.call(arguments);
    var length = _.max(_.pluck(args, 'length'));
    var results = new Array(length);
    for (var i = 0; i < length; i++) results[i] = _.pluck(args, "" + i);
    return results;
  };

  // If the browser doesn't supply us with indexOf (I'm looking at you, **MSIE**),
  // we need this function. Return the position of the first occurrence of an
  // item in an array, or -1 if the item is not included in the array.
  // Delegates to **ECMAScript 5**'s native `indexOf` if available.
  // If the array is large and already in sort order, pass `true`
  // for **isSorted** to use binary search.
  _.indexOf = function(array, item, isSorted) {
    if (array == null) return -1;
    if (isSorted) {
      var i = _.sortedIndex(array, item);
      return array[i] === item ? i : -1;
    }
    if (nativeIndexOf && array.indexOf === nativeIndexOf) return array.indexOf(item);
    for (var i = 0, l = array.length; i < l; i++) if (array[i] === item) return i;
    return -1;
  };


  // Delegates to **ECMAScript 5**'s native `lastIndexOf` if available.
  _.lastIndexOf = function(array, item) {
    if (array == null) return -1;
    if (nativeLastIndexOf && array.lastIndexOf === nativeLastIndexOf) return array.lastIndexOf(item);
    var i = array.length;
    while (i--) if (array[i] === item) return i;
    return -1;
  };

  // Generate an integer Array containing an arithmetic progression. A port of
  // the native Python `range()` function. See
  // [the Python documentation](http://docs.python.org/library/functions.html#range).
  _.range = function(start, stop, step) {
    var args  = slice.call(arguments),
        solo  = args.length <= 1,
        start = solo ? 0 : args[0],
        stop  = solo ? args[0] : args[1],
        step  = args[2] || 1,
        len   = Math.max(Math.ceil((stop - start) / step), 0),
        idx   = 0,
        range = new Array(len);
    while (idx < len) {
      range[idx++] = start;
      start += step;
    }
    return range;
  };

  // Function (ahem) Functions
  // ------------------

  // Create a function bound to a given object (assigning `this`, and arguments,
  // optionally). Binding with arguments is also known as `curry`.
  _.bind = function(func, obj) {
    var args = slice.call(arguments, 2);
    return function() {
      return func.apply(obj || {}, args.concat(slice.call(arguments)));
    };
  };

  // Bind all of an object's methods to that object. Useful for ensuring that
  // all callbacks defined on an object belong to it.
  _.bindAll = function(obj) {
    var funcs = slice.call(arguments, 1);
    if (funcs.length == 0) funcs = _.functions(obj);
    each(funcs, function(f) { obj[f] = _.bind(obj[f], obj); });
    return obj;
  };

  // Memoize an expensive function by storing its results.
  _.memoize = function(func, hasher) {
    var memo = {};
    hasher = hasher || _.identity;
    return function() {
      var key = hasher.apply(this, arguments);
      return key in memo ? memo[key] : (memo[key] = func.apply(this, arguments));
    };
  };

  // Delays a function for the given number of milliseconds, and then calls
  // it with the arguments supplied.
  _.delay = function(func, wait) {
    var args = slice.call(arguments, 2);
    return setTimeout(function(){ return func.apply(func, args); }, wait);
  };

  // Defers a function, scheduling it to run after the current call stack has
  // cleared.
  _.defer = function(func) {
    return _.delay.apply(_, [func, 1].concat(slice.call(arguments, 1)));
  };

  // Internal function used to implement `_.throttle` and `_.debounce`.
  var limit = function(func, wait, debounce) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      var throttler = function() {
        timeout = null;
        func.apply(context, args);
      };
      if (debounce) clearTimeout(timeout);
      if (debounce || !timeout) timeout = setTimeout(throttler, wait);
    };
  };

  // Returns a function, that, when invoked, will only be triggered at most once
  // during a given window of time.
  _.throttle = function(func, wait) {
    return limit(func, wait, false);
  };

  // Returns a function, that, as long as it continues to be invoked, will not
  // be triggered. The function will be called after it stops being called for
  // N milliseconds.
  _.debounce = function(func, wait) {
    return limit(func, wait, true);
  };

  // Returns the first function passed as an argument to the second,
  // allowing you to adjust arguments, run code before and after, and
  // conditionally execute the original function.
  _.wrap = function(func, wrapper) {
    return function() {
      var args = [func].concat(slice.call(arguments));
      return wrapper.apply(this, args);
    };
  };

  // Returns a function that is the composition of a list of functions, each
  // consuming the return value of the function that follows.
  _.compose = function() {
    var funcs = slice.call(arguments);
    return function() {
      var args = slice.call(arguments);
      for (var i=funcs.length-1; i >= 0; i--) {
        args = [funcs[i].apply(this, args)];
      }
      return args[0];
    };
  };

  // Object Functions
  // ----------------

  // Retrieve the names of an object's properties.
  // Delegates to **ECMAScript 5**'s native `Object.keys`
  _.keys = nativeKeys || function(obj) {
    if (_.isArray(obj)) return _.range(0, obj.length);
    var keys = [];
    for (var key in obj) if (hasOwnProperty.call(obj, key)) keys[keys.length] = key;
    return keys;
  };

  // Retrieve the values of an object's properties.
  _.values = function(obj) {
    return _.map(obj, _.identity);
  };

  // Return a sorted list of the function names available on the object.
  // Aliased as `methods`
  _.functions = _.methods = function(obj) {
    return _.filter(_.keys(obj), function(key){ return _.isFunction(obj[key]); }).sort();
  };

  // Extend a given object with all the properties in passed-in object(s).
  _.extend = function(obj) {
    each(slice.call(arguments, 1), function(source) {
      for (var prop in source) obj[prop] = source[prop];
    });
    return obj;
  };

  // Create a (shallow-cloned) duplicate of an object.
  _.clone = function(obj) {
    return _.isArray(obj) ? obj.slice() : _.extend({}, obj);
  };

  // Invokes interceptor with the obj, and then returns obj.
  // The primary purpose of this method is to "tap into" a method chain, in
  // order to perform operations on intermediate results within the chain.
  _.tap = function(obj, interceptor) {
    interceptor(obj);
    return obj;
  };

  // Perform a deep comparison to check if two objects are equal.
  _.isEqual = function(a, b) {
    // Check object identity.
    if (a === b) return true;
    // Different types?
    var atype = typeof(a), btype = typeof(b);
    if (atype != btype) return false;
    // Basic equality test (watch out for coercions).
    if (a == b) return true;
    // One is falsy and the other truthy.
    if ((!a && b) || (a && !b)) return false;
    // Unwrap any wrapped objects.
    if (a._chain) a = a._wrapped;
    if (b._chain) b = b._wrapped;
    // One of them implements an isEqual()?
    if (a.isEqual) return a.isEqual(b);
    // Check dates' integer values.
    if (_.isDate(a) && _.isDate(b)) return a.getTime() === b.getTime();
    // Both are NaN?
    if (_.isNaN(a) && _.isNaN(b)) return false;
    // Compare regular expressions.
    if (_.isRegExp(a) && _.isRegExp(b))
      return a.source     === b.source &&
             a.global     === b.global &&
             a.ignoreCase === b.ignoreCase &&
             a.multiline  === b.multiline;
    // If a is not an object by this point, we can't handle it.
    if (atype !== 'object') return false;
    // Check for different array lengths before comparing contents.
    if (a.length && (a.length !== b.length)) return false;
    // Nothing else worked, deep compare the contents.
    var aKeys = _.keys(a), bKeys = _.keys(b);
    // Different object sizes?
    if (aKeys.length != bKeys.length) return false;
    // Recursive comparison of contents.
    for (var key in a) if (!(key in b) || !_.isEqual(a[key], b[key])) return false;
    return true;
  };

  // Is a given array or object empty?
  _.isEmpty = function(obj) {
    if (_.isArray(obj) || _.isString(obj)) return obj.length === 0;
    for (var key in obj) if (hasOwnProperty.call(obj, key)) return false;
    return true;
  };

  // Is a given value a DOM element?
  _.isElement = function(obj) {
    return !!(obj && obj.nodeType == 1);
  };

  // Is a given value an array?
  // Delegates to ECMA5's native Array.isArray
  _.isArray = nativeIsArray || function(obj) {
    return toString.call(obj) === '[object Array]';
  };

  // Is a given variable an arguments object?
  _.isArguments = function(obj) {
    return !!(obj && hasOwnProperty.call(obj, 'callee'));
  };

  // Is a given value a function?
  _.isFunction = function(obj) {
    return !!(obj && obj.constructor && obj.call && obj.apply);
  };

  // Is a given value a string?
  _.isString = function(obj) {
    return !!(obj === '' || (obj && obj.charCodeAt && obj.substr));
  };

  // Is a given value a number?
  _.isNumber = function(obj) {
    return !!(obj === 0 || (obj && obj.toExponential && obj.toFixed));
  };

  // Is the given value `NaN`? `NaN` happens to be the only value in JavaScript
  // that does not equal itself.
  _.isNaN = function(obj) {
    return obj !== obj;
  };

  // Is a given value a boolean?
  _.isBoolean = function(obj) {
    return obj === true || obj === false;
  };

  // Is a given value a date?
  _.isDate = function(obj) {
    return !!(obj && obj.getTimezoneOffset && obj.setUTCFullYear);
  };

  // Is the given value a regular expression?
  _.isRegExp = function(obj) {
    return !!(obj && obj.test && obj.exec && (obj.ignoreCase || obj.ignoreCase === false));
  };

  // Is a given value equal to null?
  _.isNull = function(obj) {
    return obj === null;
  };

  // Is a given variable undefined?
  _.isUndefined = function(obj) {
    return obj === void 0;
  };

  // Utility Functions
  // -----------------

  // Run Underscore.js in *noConflict* mode, returning the `_` variable to its
  // previous owner. Returns a reference to the Underscore object.
  _.noConflict = function() {
    root._ = previousUnderscore;
    return this;
  };

  // Keep the identity function around for default iterators.
  _.identity = function(value) {
    return value;
  };

  // Run a function **n** times.
  _.times = function (n, iterator, context) {
    for (var i = 0; i < n; i++) iterator.call(context, i);
  };

  // Add your own custom functions to the Underscore object, ensuring that
  // they're correctly added to the OOP wrapper as well.
  _.mixin = function(obj) {
    each(_.functions(obj), function(name){
      addToWrapper(name, _[name] = obj[name]);
    });
  };

  // Generate a unique integer id (unique within the entire client session).
  // Useful for temporary DOM ids.
  var idCounter = 0;
  _.uniqueId = function(prefix) {
    var id = idCounter++;
    return prefix ? prefix + id : id;
  };

  // By default, Underscore uses ERB-style template delimiters, change the
  // following template settings to use alternative delimiters.
  _.templateSettings = {
    evaluate    : /<%([\s\S]+?)%>/g,
    interpolate : /<%=([\s\S]+?)%>/g
  };

  // JavaScript micro-templating, similar to John Resig's implementation.
  // Underscore templating handles arbitrary delimiters, preserves whitespace,
  // and correctly escapes quotes within interpolated code.
  _.template = function(str, data) {
    var c  = _.templateSettings;
    var tmpl = 'var __p=[],print=function(){__p.push.apply(__p,arguments);};' +
      'with(obj||{}){__p.push(\'' +
      str.replace(/\\/g, '\\\\')
         .replace(/'/g, "\\'")
         .replace(c.interpolate, function(match, code) {
           return "'," + code.replace(/\\'/g, "'") + ",'";
         })
         .replace(c.evaluate || null, function(match, code) {
           return "');" + code.replace(/\\'/g, "'")
                              .replace(/[\r\n\t]/g, ' ') + "__p.push('";
         })
         .replace(/\r/g, '\\r')
         .replace(/\n/g, '\\n')
         .replace(/\t/g, '\\t')
         + "');}return __p.join('');";
    var func = new Function('obj', tmpl);
    return data ? func(data) : func;
  };

  // The OOP Wrapper
  // ---------------

  // If Underscore is called as a function, it returns a wrapped object that
  // can be used OO-style. This wrapper holds altered versions of all the
  // underscore functions. Wrapped objects may be chained.
  var wrapper = function(obj) { this._wrapped = obj; };

  // Expose `wrapper.prototype` as `_.prototype`
  _.prototype = wrapper.prototype;

  // Helper function to continue chaining intermediate results.
  var result = function(obj, chain) {
    return chain ? _(obj).chain() : obj;
  };

  // A method to easily add functions to the OOP wrapper.
  var addToWrapper = function(name, func) {
    wrapper.prototype[name] = function() {
      var args = slice.call(arguments);
      unshift.call(args, this._wrapped);
      return result(func.apply(_, args), this._chain);
    };
  };

  // Add all of the Underscore functions to the wrapper object.
  _.mixin(_);

  // Add all mutator Array functions to the wrapper.
  each(['pop', 'push', 'reverse', 'shift', 'sort', 'splice', 'unshift'], function(name) {
    var method = ArrayProto[name];
    wrapper.prototype[name] = function() {
      method.apply(this._wrapped, arguments);
      return result(this._wrapped, this._chain);
    };
  });

  // Add all accessor Array functions to the wrapper.
  each(['concat', 'join', 'slice'], function(name) {
    var method = ArrayProto[name];
    wrapper.prototype[name] = function() {
      return result(method.apply(this._wrapped, arguments), this._chain);
    };
  });

  // Start chaining a wrapped Underscore object.
  wrapper.prototype.chain = function() {
    this._chain = true;
    return this;
  };

  // Extracts the result from a wrapped and chained object.
  wrapper.prototype.value = function() {
    return this._wrapped;
  };

})();


$$ = jQuery;
Object.extend = jQuery.extend;

document.viewport = {
  getDimensions: function() {
    return { width: $(window).width(), height: $(window).height() };
  },

  getScrollOffsets: function() {
    return [
      window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
      window.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
    ];
  }
};

Effect = {
  toggle: function(id, type, options) {
    $('#' + id).animate({height: 'toggle'}, options || {});
  },
	Highlight: function(element, options, speed, callback) {
		$(element).effect("highlight", options || {});
	}
};

Control = {
	Modal: function(selector, options) {
    options = options || {};
    var optionsMap = {
      'jQPos': 'position'
    };

    var eventsMap = {
      'afterOpen': 'open'
    };

    for(var i in options) {
      if(optionsMap[i]) {
        options[optionsMap[i]] = options[i];
        delete options[i];
      }
    }

    for(var event in eventsMap) {
      if(options[event]) {
        $(selector).bind(eventsMap[event], options[event]);
      }
    }

    $.extend(options, {
      autoOpen: false
    });

    if($.type(selector) == 'string' && (selector.indexOf('#') !== 0))
      selector = '#' + selector;

    if($(selector).data('modal'))
      return $(selector).data('modal');

    var modal = $(selector).modal(options);
    return modal ? modal.data('modal') : $(selector);
  }
};

//Prototype's Element contstructor :-)
function Element(tag, options) {
  options = options || {};
  return $(document.createElement(tag)).attr(options);
}

jQuery.extend(Control.Modal, {
  open: function(el, opts) {
    var modal = new this(el, opts);
    if(modal.open)
      modal.open();
  },
  close: function(){
    $.ui.modal.instances.each(function(modal){ modal.close(); });
  }
});

(function($) {

  var prototypeMethods = {
    Array: ["each", "map", "reduce", "inject", "reduceRight", "detect", "select", "reject", "all", "any", "include", "invoke", "pluck", "max", "min", "sortBy", "sortedIndex", "size", "first", "rest", "last", "compact", "flatten", "without", "uniq", "intersect", "zip", "indexOf", "lastIndexOf", "range"],
    Function: ["bind", "bindAll", "memoize", "delay", "defer", "throttle", "debounce", "wrap", "compose"]
  };

  for(var obj in prototypeMethods) {
    _.each(prototypeMethods[obj], function(method, i) {
      window[obj].prototype[method] = function() {
        var args = Array.prototype.slice.apply(arguments);
        args.unshift(this);
        return _[method].apply(window, args);
      };
    });
  }

  Array.prototype.uniq = (function(original) {
    return function() {
      if($.type(this[0]) == 'object') {
        var jsonArray = [];
        var newArray = [];
        this.each(function(value, i, orig){
          if(jQuery.inArray(jQuery.toJSON(value), jsonArray) == -1) {
            jsonArray.push(jQuery.toJSON(value));
            newArray.push(value);
          }
        });
        return newArray;
      }
      else
        return original.apply(this);
    };
  })(Array.prototype.uniq);

  $.extend(Function.prototype, {
    argumentNames: function() {
      var names = this.toString().match(/^[\s\(]*function[^(]*\(([^)]*)\)/)[1]
        .replace(/\/\/.*?[\r\n]|\/\*(?:.|[\r\n])*?\*\//g, '')
        .replace(/\s+/g, '').split(',');
      return names.length == 1 && !names[0] ? [] : names;
    }
  });

  $.extend(String.prototype, (function() {
    function blank(){
      return (/^\s*$/).test(this);
    }

    function capitalize() {
      return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
    }

    function stripTags() {
      return this.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi, '');
    }

    function escapeHTML() {
      return this.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    function evalJSON() {
      return $.parseJSON(this + '');
    }

    function unescapeHTML() {
      return this.stripTags().replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');
    }

    function toQueryParams(separator) {
      var match = this.match(/([^?#]*)(#.*)?$/);
      if (!match) return { };

      return match[1].split(separator || '&').inject({ }, function(hash, pair) {
        if ((pair = pair.split('='))[0]) {
          var key = decodeURIComponent(pair.shift()),
              value = pair.length > 1 ? pair.join('=') : pair[0];

          if (value != undefined) value = decodeURIComponent(value);

          if (key in hash) {
            if (!$.type(hash[key]) == 'array') hash[key] = [hash[key]];
            hash[key].push(value);
          }
          else hash[key] = value;
        }
        return hash;
      });
    }

    return {
      blank        : blank,
      capitalize   : capitalize,
      empty        : blank,
      escapeHTML   : escapeHTML,
      evalJSON     : evalJSON,
      stripHTML    : stripTags,
      stripTags    : stripTags,
      toQueryParams: toQueryParams,
      unescapeHTML : unescapeHTML
    };
  })());

  RegExp.escape = function(str) {
    return String(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
  };

})(jQuery);

(function($) {
  var $break = { };

  $.Utility = {
    Array: function(array) {
      this.initialize(array);
    },

    Hash: function(object) {
      this.initialize(object);
    }
  };

  $.Utility.Hash.prototype = {

    initialize: function(object) {
      this._object = object;
      return this;
    },

    each: function(iterator, context) {
      var index = 0;
      try {
        for (var key in this._object) {
          var value = this._object[key], pair = [key, value];
          pair.key = key;
          pair.value = value;
          iterator(pair);
        }
      } catch (e) {
      if (e != $break) throw e;
      }
      return this;
    },

    keys: function() {
      var keys = [];
      for (var key in this._object) keys.push(key);
      return keys;
    },

    merge: function(object) {
      for (var prop in object) {
        this._object[prop] = object[prop];
      }
      return this;
    },

    get: function(key) {
      for(var prop in this._object) {
        if(prop == key)
          return this._object[prop];
      }
      return undefined;
    },

    toQueryString: function() {
      return $.param(this._object);
    }

  };

  $.Utility.Array.prototype = {
    initialize: function(array) {
			if (!array) return;
      this._array = array;
      this.length = this._array.length;
      for(var i = 0; i < this.length; i++) {
        this[i] = this._array[i];
      }
    },

    each: function(iterator, context) {
      for (var i = 0, length = this.length; i < length; i++)
        iterator.call(context, this[i], i);
    },

    map: function(callback) {
      var ret = [], value;
      for (var i = 0, length = this.length; i < length; i++) {
        value = callback(this[ i ], i);

        if (value !== null) {
          ret[ret.length] = value;
        }
      }
      return ret.concat.apply([], ret);
    },

    compact: function() {
      var ret = [];
      this.each(function(el, i) {
        if(el !== null)
          ret.push(el);
      });
      return ret;
    },

    push: [].push,
    sort: [].sort,
    splice: [].splice
  };

})(jQuery);

(function() {
  prototypeAliases = {
    'addClassName'   : 'addClass',
    'cumulativeOffset': 'offset',
    'down'					 : 'find',
    'fire'           : 'trigger',
    'getHeight'      : 'height',
    'getStyle'       : 'css',
    'getWidth'       : 'width',
    'getValue'       : 'val',
    'hasClassName'   : 'hasClass',
    'match'          : 'is',
    'observe'        : 'bind',
    'readAttribute'  : 'attr',
    'removeClassName': 'removeClass',
    'replace'        : 'replaceWith',
    'select'         : 'find',
    'setStyle'       : 'css',
    'setValue'       : 'val',
    'stopObserving'  : 'unbind',
    'toggleClassName': 'toggleClass',
    'up'             : 'closest',
    'update'         : 'html',
		'writeAttribute' : 'attr'
  };

  for(var i in prototypeAliases){
    $.fn[i] = $.fn[prototypeAliases[i]];
  }

})();

function $F(element_or_id) {
  if(element_or_id.nodeType || (element_or_id instanceof jQuery)) {
    return $(element_or_id).val();
  }
  else
    return $('#' + element_or_id).val();
}

if(!$H)
	var $H = function(object) {
		return new jQuery.Utility.Hash(object);
	};

if(!$A)
  var $A = function(array) {
    return new jQuery.Utility.Array(array);
  };

(function($){
  $.fn.classNames = function() {
    return this.attr('class').split(/\s/);
  };

  $.fn.disable = function() {
    return this.attr('disabled', true);
  };

  $.fn.enable = function(){
    return this.attr('disabled', false);
  };

  $.fn.getDimensions = function() {
    var height = this.getHeight();
    var width = this.getWidth();
    return {'height': height, 'width': width};
  };

  $.fn.identify = function() {
    if(typeof $.idCounter == 'undefined')
      $.idCounter = 0;

    var el = this.first();
    var id = el.attr('id');
    if (id) return id;
    do { $.idCounter++; id = 'anonymous_element_' + $.idCounter; } while ($('#' + id).length > 0);
    el.attr('id', id);
    return id;
  };

  //$(this.element).insert({top: selected});
  $.fn.insert = function(elementOrHash) {
    if((elementOrHash instanceof jQuery) || ($.type(elementOrHash) == 'string')){
      var element = elementOrHash;
      this.append(element);
    }

    else {
      var insertionHash = elementOrHash;
      for(var position in insertionHash){
        switch(position) {
        case 'top':
          this.prepend(insertionHash[position]);
          break;
        case 'bottom':
          this.append(insertionHash[position]);
          break;
        case 'before':
          this.before(insertionHash[position]);
          break;
        case 'after':
          this.after(insertionHash[position]);
          break;
        default:
          this.append(insertionHash[position]);
          break;
        }
      }
    }
    return this;
  };

  $.fn.invoke = function() {
    var args = Array.prototype.slice.call(arguments);
    var method = args.shift();
    this[method].apply(this, args);
    return this;
  };

	$.fn.positionedOffset = function() {
		var _offset = this.position();
		return [_offset.left, _offset.top];
	};

  $.fn.request = function(opts) {
		var jqopts = {
			url: this.attr('action'),
			type: this.attr('method') || 'GET',
			data: this.serialize()
		};
		new Ajax.Request(jqopts.url, $.extend(opts, jqopts));
		return this;
	};

  $.fn.serialize = (function(oldSerialize) {
    return function(toHash) {
      var params = {};
      if(toHash)
        return $(this).serializeArray().inject(function(acc, obj) {
          acc[obj.name] = obj.value;
          return acc;
        }, {});
      else
        return oldSerialize.apply(this, arguments);
    };
  })($.fn.serialize);

  $.fn.setCaretPosition = function(position) {
    return this.each(function(i, el) {
      if (position == 'end')
        position = $(el).val().length;

      if (el.createTextRange) {
        var range = element.createTextRange();
        range.move('character', position);
        range.select();
      } else {
        el.focus();
        if (el.setSelectionRange)
          el.setSelectionRange(position, position);
      }
    });
  };

  $.toJSON = function(o) {
    if (typeof(JSON) == 'object' && JSON.stringify)
      return JSON.stringify(o);

    var type = typeof(o);

    if (o === null)
        return "null";

    if (type == "undefined")
        return undefined;

    if (type == "number" || type == "boolean")
        return o + "";

    if (type == "string")
        return o;

    if (type == 'object') {
      if (typeof o.toJSON == "function")
        return $.toJSON( o.toJSON() );

      if (o.constructor === Date) {
        var month = o.getUTCMonth() + 1;
        if (month < 10) month = '0' + month;

        var day = o.getUTCDate();
        if (day < 10) day = '0' + day;

        var year = o.getUTCFullYear();

        var hours = o.getUTCHours();
        if (hours < 10) hours = '0' + hours;

        var minutes = o.getUTCMinutes();
        if (minutes < 10) minutes = '0' + minutes;

        var seconds = o.getUTCSeconds();
        if (seconds < 10) seconds = '0' + seconds;

        var milli = o.getUTCMilliseconds();
        if (milli < 100) milli = '0' + milli;
        if (milli < 10) milli = '0' + milli;

        return '"' + year + '-' + month + '-' + day + 'T' +
                     hours + ':' + minutes + ':' + seconds +
                     '.' + milli + 'Z"';
      }

      if (o.constructor === Array) {
        var ret = [];
        for (var i = 0; i < o.length; i++)
            ret.push( $.toJSON(o[i]) || "null" );

        return "[" + ret.join(",") + "]";
      }

      var pairs = [];
      for (var k in o) {
        var name;
        type = typeof k;

        if (type == "number")
          name = '"' + k + '"';
        else if (type == "string")
          name = k;
        else
          continue;  //skip non-string or number keys

        if (typeof o[k] == "function")
          continue;  //skip pairs where the value is a function.

        var val = $.toJSON(o[k]);

        pairs.push(name + ":" + val);
      }

      return "{" + pairs.join(", ") + "}";
    }
  };

  $.fn.viewportOffset =  function() {
    var element = this;
    return [element.cumulativeOffset().left - $(window).scrollLeft(), element.cumulativeOffset().top - $(window).scrollTop()];
  };

  $.fn.visible = function() {
    return this.is(':visible');
  };

  $.event.special.mouseleaveintent = {
    setup: function(data, namespaces) {
      var elem = this, $elem = $(elem), timer;
      var options = {
        timeout: 500
      };

      $elem.bind('mouseleave.intent', function(e) {
        var event = e;
        timer = setTimeout(function() {
          $.event.special.mouseleaveintent._handler.call(this, event);
        }.bind(this), options.timeout);
      });

      $elem.bind('mouseenter', function() {
        clearTimeout(timer);
      });
    },

    teardown: function(namespaces) {
      var elem = this, $elem = $(elem);
      $elem.unbind('mouseleave.intent');
    },

    _handler: function(event) {
      var elem = this, $elem = $(elem);
      event.type = 'mouseleaveintent';
      $.event.handle.apply(this, arguments);
    }
  };


  (function($,doc,outside){
    $.map(
      'click dblclick mousemove mousedown mouseup mouseover mouseout change select submit keydown keypress keyup'.split(' '),
      function( event_name ) { jq_addOutsideEvent( event_name ); }
    );

    jq_addOutsideEvent( 'focusin',  'focus' + outside );
    jq_addOutsideEvent( 'focusout', 'blur' + outside );
    $.addOutsideEvent = jq_addOutsideEvent;
    function jq_addOutsideEvent( event_name, outside_event_name ) {

      outside_event_name = outside_event_name || event_name + outside;
      var elems = $(),
      event_namespaced = event_name + '.' + outside_event_name + '-special-event';
      $.event.special[ outside_event_name ] = {

        setup: function(){
         elems = elems.add( this );
          if ( elems.length === 1 ) {
            $(doc).bind( event_namespaced, handle_event );
          }
        },
        teardown: function(){
          elems = elems.not( this );
          if ( elems.length === 0 ) {
            $(doc).unbind( event_namespaced );
          }
        },

        add: function( handleObj ) {
          var old_handler = handleObj.handler;
          handleObj.handler = function( event, elem ) {
            event.target = elem;
            old_handler.apply( this, arguments );
          };
        }
      };

      function handle_event( event ) {
        $(elems).each(function(){
          var elem = $(this);

          if ( this !== event.target && !elem.has(event.target).length ) {
            elem.triggerHandler( outside_event_name, [ event.target ] );
          }
        });
      }
    }

  })($, document, 'outside');


  $.extend($.Event.prototype, {
    stop: $.Event.prototype.preventDefault,
    element: function(){
      return $(this.target);
    }
  });

})(jQuery);

var Ajax = {
  Request: function(url, options) {
    var optionMap = {
      'asynchronous': 'async',
      'method'      : 'type',
      'onComplete'  : 'success',
      'onFailure'   : 'error',
      'onSuccess'   : 'success',
      'postBody'    : 'data',
      'parameters'  : 'data'
    };

    for(var prop in options) {
      if(optionMap[prop]) {
        options[optionMap[prop]] = options[prop];
        delete options[prop];
      }
    }

    options = $.extend(options, {url: url});
    if(options.requestHeaders)
      options.beforeSend = function (request){
        for(var header in options.requestHeaders){
          request.setRequestHeader(header, options.requestHeaders[header]);
        }
      };

    $.ajax(options);
  }
};

if($.widget) {
  $.widget('ui.modal', $.ui.dialog, {
    _init: function(options) {
      var self = this;
      this.options.modal = (this.element.data('overlay') !== undefined) ? this.element.data('overlay') : true;
      $('.ui-widget-overlay').die('click.ui-modal');
      $('.ui-widget-overlay').live('click.ui-modal', function() {
        self.close();
      });
      this.uiDialog = this.element;
      this.container = this.element.parent();
      $.ui.modal.instances.push(this);
      if ( this.options.autoOpen ) {
        this.open();
      }
    },

    destroy: function() {
      if (this.overlay) {
        this.overlay.destroy();
      }
      this.element.unbind('.dialog').
        removeData('dialog').
        removeClass('ui-dialog-content ui-widget-content').
        hide().appendTo('body');

      return this;
    },

    open: function() {
      if (this._isOpen) { return this; }
      var data = this.element.data();
      this.uiDialog = this.element = this.element.detach().data(data).appendTo('body');
      return $.ui.dialog.prototype.open.apply(this);
    },

    close: function() {
      var data = this.element.data();
      this.uiDialog = this.element = this.element.detach().data(data).appendTo(this.container);
      return $.ui.dialog.prototype.close.apply(this);
    },

    _size: function() {},

    _create: function() {
      if(this.options.draggable)
        this._makeDraggable();
    },

    _makeDraggable: function() {
      this.element.draggable({
        cancel: '.modal_window .close',
        handle: '.modal_header',
        containment: 'document'
      });

    }
  });

  $.extend($.ui.modal, {
    instances: []
  });
}



(function($) {

  $.extend($.Widget.prototype, {
    _bindings: function() {
      var bindings = [], prop;
      for(prop in this) {
        if(prop.match($.Widget.revent) && $.type(this[prop]) == 'function'){
          var target = RegExp.$1, event = RegExp.$2;
          bindings.push({
            method: this[prop],
            target: target,
            event: event
          });
        }
      }
      return bindings;
    }
  });

  $.Widget.revent = /([\w\s\.#\[\]="']+)?(?:\s|^)(change|click|contextmenu|dblclick|keydown|keyup|keypress|mousedown|mousemove|mouseout|mouseover|mouseup|reset|windowresize|resize|windowscroll|scroll|select|submit|dblclick|focusin|focusout|load|unload|ready|hashchange|mouseenter|mouseleave)/; 

  $.behavior = function(name, base, prototype) {
    $.widget(name, base, prototype);

    var namespace = name.split( "." )[ 0 ];
    name = name.split( "." )[ 1 ];
    
    var object = $[ namespace ][ name ];
    var behavior = $[ namespace ][ name ] = function(options, element) {
      if ( arguments.length ) {
        object.call(this, options, element);
        $.each(this._bindings(), $.proxy(function(i, binding){
          var handler = $.proxy(binding.method, this);
          if(binding.target)
            this.element.delegate(binding.target, binding.event, handler);
          else
            this.element.bind(binding.event, handler);
        }, this));
      }
    };

    var proto = $[ namespace ][ name ].prototype = object.prototype;

    // add _super method if we're overriding any methods on base class
    if(base.prototype){
      for(var method in proto){
        proto[method] = ($.isFunction(proto[method]) && $.isFunction(base.prototype[method])) ? (function(name, fn){
          return function() {
            var tmp = this._super;
            
            // Add a new ._super() method that is the same method
            // but on the super-class
            this._super = base.prototype[name];
            
            // The method only need to be bound temporarily, so we
            // remove it when we're done executing
            var ret = fn.apply(this, arguments);        
            this._super = tmp;
            
            return ret;
          };
        })(method, proto[ method ]) : proto[ method ];
      }
    }

    $.widget.bridge(name, $[ namespace ][ name ]);

    var plugin = $.fn[ name ];

    //extend plugin method with .live delegation
    $.fn[ name ] = function( options ) {
      $.each(this.selector.split(/,\s?/), function(i, selector) {
        var behavior = $[ namespace ][ name ].prototype,
            parts = selector.split(' '),
            context = parts.length > 1 ? parts[0] : document;
        selector = (parts.length > 1 ? parts.slice(1) : parts).join(' ');
        $.each(behavior._bindings(), $.proxy(function(i, binding) {
          var handler = function(event) {
            if(!$(this).data(name)) {
              var instance = $(this)[name].call($(this)).data(name);
              instance[event.type].call(instance, event, this);
            }
          };
          if(!binding.target){
            $(context).delegate(selector, binding.event, handler);
          }
        }, this));
      });
      var returnVal = plugin.call(this, options);
      return returnVal;
    };
    
    return behavior;
  };

})(jQuery);


var Class = {
  create: function() {
    var parent = null, properties = $.makeArray(arguments);
    if ($.isFunction(properties[0])) parent = properties.shift();

    var klass = function() {
      this.initialize.apply(this, arguments);
    };

    klass.superclass = parent;
    klass.subclasses = [];
    klass.addMethods = Class.addMethods;

    if (parent) {
      var subclass = function() { };
      subclass.prototype = parent.prototype;
      klass.prototype = new subclass;
      parent.subclasses.push(klass);
    }

    for (var i = 0; i < properties.length; i++)
      klass.addMethods(properties[i]);

    if (!klass.prototype.initialize){
      klass.prototype.initialize = function() {};
    }

    klass.prototype.constructor = klass;

    return klass;
  },

  addMethods: function(source) {
    var ancestor   = this.superclass && this.superclass.prototype;
    var properties = [];
    for(var prop in source){
      properties.push(prop);
    }

    for (var i = 0, length = properties.length; i < length; i++) {
      var property = properties[i], value = source[property];
      if (ancestor && $.isFunction(value) && $.argumentNames(value)[0] == "$super") {

        var method = value, value = $.extend($.wrap((function(m) {
          return function() { return ancestor[m].apply(this, arguments); };
        })(property), method), {
          valueOf:  function() { return method; },
          toString: function() { return method.toString(); }
        });
      }
      this.prototype[property] = value;
    }

    return this;
  }
};

$.counter = 0;

var Behavior = {

  create: function() {
    var params = $.makeArray(arguments),
        name = $.type(params[0]) == 'string' ? params.shift() : 'anonymous-behavior' + $.counter++,
        className = 'Groupon.' + name,
        parent = $.isFunction(params[0]) ? params.shift() : null,
        methods = params[0];
        args = [className, methods];

    this.name = name;

    if(parent)
      args.splice(1, 0, parent);

    for(var method in methods) {
      if(method.match(/^on(.+)/)){
        var event = RegExp.$1;
        methods[event] = methods[method];
      }
    }
    methods._init = methods.initialize;
    var behavior = $.behavior.apply(window, args);
    window[name] = behavior;
    $.extend(behavior, Behavior.ClassMethods);
    return behavior;
  },

  ClassMethods : {
    attach : function(element) {
      var name = this.prototype.widgetName;
      return $(element)[name].call($(element)).data(name);
    }
  }

};

(function($) {

  $.extend({
    keys: function(obj) {
      var keys = [];
      for (var key in obj) keys.push(key);
      return keys;
    },

    argumentNames: function(func) {
      var names = func.toString().match(/^[\s\(]*function[^(]*\((.*?)\)/)[1].split(/, ?/);
      return names.length == 1 && !names[0] ? [] : names;
    },

    bind: function(func, scope) {
      return function() {
        return func.apply(scope, $.makeArray(arguments));
      };
    },

    wrap: function(func, wrapper) {
      var __method = func;
      return function() {
        return wrapper.apply(this, [$.bind(__method, this)].concat($.makeArray(arguments)));
      };
    },

    delegate: function(rules) {
      return function(e) {
        var target = $(e.target), parent = null;
        for (var selector in rules) {
          if (target.is(selector) || ((parent = target.parents(selector)) && parent.length > 0)) {
            return rules[selector].apply(this, $.makeArray(arguments));
          }
          parent = null;
        }
        return this;
      };
    }
  });

  $.fn.extend({
    attach: function() {
      var that = this;
      var args = $.makeArray(arguments), behavior = args.shift();
      if(behavior.attach){
        return $(this)[behavior.prototype.widgetName].call($(this));
      }
      return this.each(function() {
        behavior.call(this);
      });
    },

    attachAndReturn: function() {
      var that = this;
      var args = $.makeArray(arguments), behavior = args[0], name = behavior.prototype.widgetName;
      return $.map(this[name].apply(this, arguments), function(el) {
        return $(el).data(name);
      });
    }

  });

  Remote = Behavior.create({
    initialize: function(options) {
      if (this.element.attr('nodeName') == 'FORM') this.element.attach(Remote.Form, options);
      else{
        this.element.attach(Remote.Link, options);
      }
    }
  });

  Remote.Base = Behavior.create({
    initialize : function(options) {
      var self = this;
      this.options = $.extend({
        beforeSend: function(xhr) {
          if(self.element.trigger('beforeSend', [xhr]) === false) {
            return false;
          }
        },
        success: function(e, response, status) {
          self.element.trigger('success', [e, response, status]);
        },
        complete: function(xhr) {
          self.element.trigger('complete', xhr);
        },
        error: function(xhr, status, error) {
          self.element.trigger('error', [xhr, status, error]);
        }
      }, options);
    },

    _makeRequest : function(options) {
      this.element.trigger('beforeAjax', [options]);
      $.ajax(options);
      return false;
    }
  });

  Remote.Link = Behavior.create(Remote.Base, {
    onclick: function(e) {
      e.preventDefault();
      var options = $.extend({ 
        url: this.element.attr('href'), 
        type: 'GET'
      }, this.options);
      return this._makeRequest(options);
    }
  });

  Remote.Form = Behavior.create(Remote.Base, {
    onclick: function(e) {
      var target = e.target;

      if ($.inArray(target.nodeName.toLowerCase(), ['input', 'button']) >= 0 && target.type.match(/submit|image/))
        this._submitButton = target;
    },
    onsubmit: function() {
      var data = this.element.find('input:not(".prompting"), select, textarea').serializeArray();

      if (this._submitButton) data.push({ name: this._submitButton.name, value: this._submitButton.value });

      var options = $.extend({
        url : this.element.attr('action'),
        type : this.element.attr('method') || 'GET',
        data : data
      }, this.options);

      this._makeRequest(options);

      return false;
    }
  });

  $.ajaxSetup({
    beforeSend: function(xhr) {
      if (!this.dataType)
        xhr.setRequestHeader("Accept", "text/javascript, text/html, application/xml, text/xml, */*");
    }
  });
  

})(jQuery);


var Event = {
  KEY_BACKSPACE: 8,
  KEY_TAB:       9,
  KEY_RETURN:   13,
  KEY_ESC:      27,
  KEY_LEFT:     37,
  KEY_UP:       38,
  KEY_RIGHT:    39,
  KEY_DOWN:     40,
  KEY_DELETE:   46,
  KEY_HOME:     36,
  KEY_END:      35,
  KEY_PAGEUP:   33,
  KEY_PAGEDOWN: 34,
  KEY_INSERT:   45
};

Event.addBehavior = function(rules) {
  $(function(){
    for(var rule in rules){
      var selectors = rule;
      var behavior = rules[rule];
      $.each(selectors.split(/,\s+/), function(index, selector){
        var parts = selector.split(/:(?=[a-z]+$)/i), css = parts[0], event = parts[1];
        if(event){
          $(css).live(event, behavior);
        }
        else {
          $(css).attach(behavior);
        }
      });
    }
  });
};

Event.onReady = function(callback) {
  $(callback);
};

Event.delegate = $.delegate;


/*
Copyright (c) 2010, Groupon. All rights reserved.
Author: Keith Norman
version: 1.0.0
*/
if (typeof Groupon.Touch == 'undefined') { Groupon.Touch = {}; }

if (typeof Event == 'undefined') Event = {};
if (typeof Event.addBehavior == 'undefined') {
	Event.addBehavior = function(rules) {
		for (var selector in rules) {
      var observer = rules[selector];
      var sels = new Groupon.Touch.Utility.Array(selector.split(','));
      sels.each(function(sel) {
        var parts = sel.split(/:(?=[a-z]+$)/), css = parts[0], event = parts[1];
        $(css).each(function(index, element) {
          if (event) {
            $(element).observe(event, observer);
          } 
					else {
						observer.call(element);
          }
        });
      });
		}
	}
}

Function.prototype.bind = function(context) {
	var slice = Array.prototype.slice;
	if (arguments.length < 2 && (typeof arguments[0] == 'undefined')) return this;
	var __method = this, args = slice.call(arguments, 1);
	return function() {
		return __method.apply(context, arguments);
	}
}


	/**
	* Groupon Utility
	*
	* @module Utilty
	* @title Utility
	* @namespace Groupon.Touch
	*/
Groupon.Touch.Utility = {
	Array: function(array) {
		this.initialize(array);
	},
	
	Hash: function(object) {
		this.initialize(object);
	}
};

Groupon.Touch.Utility.Array.prototype = {
  initialize: function(array) {
    this._array = array;
		this.length = this._array.length;
		for(var i = 0; i < this.length; i++) {
			this[i] = this._array[i];
		}
    return this;
  },

  each: function(callback, context) {
		if(this._array.forEach)
			return this._array.forEach(callback);
			
		for(var i = 0; i < this._array.length; i ++) {
			 callback(this._array[i], i);
		}
  },

	map: function(callback) {
		var ret = [], value;
		for (var i = 0, length = this.length; i < length; i++) {
			value = callback(this[ i ], i);

			if (value != null) {
				ret[ret.length] = value;
			}
		}
		return ret.concat.apply([], ret);
	},

    compact: function() {
      var ret = [];  
      this.each(function(el, i) {
        if(el != null)
          ret.push(el);
      });
      return ret;
    },
	
	push: [].push,
	sort: [].sort,
	splice: [].splice
}

Groupon.Touch.Utility.Hash.prototype = {
	initialize: function(object) {
		this._object = object;
		return this;
	},
	
	each: function(iterator, context) {
		var index = 0;
		try {
			for (var key in this._object) {
				var value = this._object[key], pair = [key, value];
				pair.key = key;
				pair.value = value;
				iterator(pair);
			}
		} catch (e) {
		if (e != $break) throw e;
		}
		return this;
	},

	merge: function(object) {
		for (var prop in object) {
			this._object[prop] = object[prop];
		}
		return this;
	},
	
	get: function(key) {
		for(var prop in this._object) {
			if(prop == key)
				return this._object[prop];
		}
		return undefined;
	}
};

if(!$H)
	var $H = function(object) {
		return new Groupon.Touch.Utility.Hash(object);
	};

if(!$A)
	var $A = function(array) {
		return new Groupon.Touch.Utility.Array(array);
	}

Groupon.Analytics = {
  debug: false,

  experimentLayerSlotMap: {
    'deal_page_042811'      : 2,
    'checkout_042811'      : 4,
    'post_subscribe_042811' : 5,
    'all_deals_042811'      : 1
  },

  trackLoad: function(category, action, label) {
    this.trackEvent('trackLoad', [category, action, label]);
  },

  trackClick: function(category, action, label) {
    this.trackEvent('trackClick', [category, action, label]);
  },

  trackPageView: function(path) {
    // This (GA's event queue) is intended to be a global variable.
    // I know you want to, but please don't add a `var`.
    _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-1250257-1']);
    _gaq.push(['_trackPageview', path]);
  },

  trackEvent: function(eventType, params, optional) {
    // track new_membership_foo_bar as category: new_membership, action: foo_bar
    if (typeof(params) == 'string'){
      if (params.search(/new_membership/) > -1) {
        params = ['new_membership', params.replace('new_membership',''), 'undefined'];
      } else {
        params = [params, 'undefined', 'undefined'];
      }
    }

    optional = Object.extend({ 'click': params[2], 'alt': params[1] }, optional);

    this.log("trackEvent", eventType, params, optional);

    this.Backend.Google.trackEvent(params[0], params[1], params[2]);
    _groanalytics.push(['trackEvent', params[0], params[1], params[2]]);
  },

  setCustomVar: function(label, value, slot, scope) {
    pageTracker._setCustomVar(slot, label, value, scope);
  },

  setDivisionCustomVar: function(newDivision) {
    this.setCustomVar("Division", newDivision, 3, this.Backend.Google.sessionScope);
  },

  setExperimentCustomVar: function(layerId, experimentId, variantId) {
    slotId       = this.experimentLayerSlotMap[layerId] || 5;

    layerId      = layerId.replace(/[\s]/g, '').replace(/[^\w]/g, '-');
    experimentId = experimentId.replace(/[\s]/g, '').replace(/[^\w]/g, '-');
    variantId    = variantId.replace(/[\s]/g, '').replace(/[^\w]/g, '-');

    name = "Exp-" + layerId;
    safeExperimentId = experimentId + "/" + variantId;
    this.setCustomVar(name, safeExperimentId, slotId, this.Backend.Google.visitorScope);
  },

  enablePDFTracking: function() {
    $$('a[href$=pdf]').each(function(a) {
      $(a).observe('click', function(event) {
        Groupon.Analytics.trackEvent('trackClick', ['DownloadPrepFlyer', a.pathname, location.pathname]);
      });
    });
  },

  log: function() {
    if (typeof console != 'undefined' && this.debug) {
      console['log'].apply(console, arguments);
    }
  }
};

Groupon.Analytics.Backend = {};

Groupon.Analytics.Backend.Local = {
  initialize: function() {
    if (typeof _groanalytics != 'undefined') {
      for (var i = 0; i < _groanalytics.length; i++) {
        this.push(_groanalytics[i]);
      }
    }

    window._groanalytics = Groupon.Analytics.Backend.Local;
  },

  push: function(methodAndArgs) {
    var method = methodAndArgs[0];
    this[method].apply(Groupon.Analytics.Backend.Local, methodAndArgs.slice(1));
  },

  trackEvent: function(category, action, label) {
    var paramString = "cat=" + category + "&act=" + action + "&lab=" + label;
    this.fireTracking("events", paramString);
  },

  fireTracking: function(type, paramString) {
    //this.sendAsyncRequest("/analytic/" + type + "?" + paramString);
    return true;
  }
};

Groupon.Analytics.Backend.Google = {
  visitorScope: 1,
  sessionScope: 2,
  pageScope: 3,
  maxCustomVarLength: 64,

  trackEvent: function(category, action, label) {
    (function triggerPageTracker() {
      if (typeof pageTracker == 'undefined') {
        setTimeout(triggerPageTracker, 1500);
      } else {
        pageTracker._trackEvent(category, action, label);
      }
    }());
  },

  trimStringLength: function(string, maxLength) {
    if (string.length > maxLength) {
      string = string.slice(string.length - maxLength);
    }
    return string;
  },

  getVariantId: function() {
    if(typeof utmx != 'undefined'){
      var variantId = utmx('combination');
      if (typeof variantId == 'undefined') {
        return '';
      } else {
        return variantId;
      }
    }
  }
};

Groupon.Analytics.EventTracking = Behavior.create({
  initialize: function() {
    this.trackOnClick = !$(this.element).hasClassName('trackNow');

    if (!this.trackOnClick) {
      this.track('trackLoad');
    }
  },

  onclick: function() {
    if (!this.trackOnClick) { return; }
    this.track('trackClick');
  },

  track: function(eventType) {
    if (this.element.readAttribute("data-google-analytics-tags") != undefined) {
      Groupon.Analytics.trackEvent(eventType, this.constructParams(this.element.readAttribute("data-google-analytics-tags").split(" ")));
    }

    var thisBehavior = this;
    $(this.element).classNames().each(function(classname) {
      if (classname.indexOf("E-") != -1) {
        Groupon.Analytics.trackEvent(eventType, thisBehavior.constructParams(classname.replace("E-","").split("_")));
      }
    });
  },
  
  constructParams: function(params) {
    for (i = 0; i < 3; i++) {
      params[i] = params[i] || " ";
    }
    return params;
  }
});

Event.addBehavior({
  '.G_event': Groupon.Analytics.EventTracking
});

Groupon.Analytics.Backend.Local.initialize();

$.behavior('Groupon.PromptingField', {
  _init: function() {
    this.changed = false;
    this.focusout();
    this.element.up('form').observe('click', this.handleFormSubmission.bind(this));
  },

  setPrompt: function() {
    this.element.setValue('');
    this.element.addClassName('prompting');
    this.element.setValue(this.element.readAttribute('title'));
    this.changed = false;
  },

  clearPrompt: function() {
    this.element.setValue('');
    this.element.removeClassName('prompting');
  },

  defaultPromptEnabled: function() {
    var whitespace_regex = /(#[^;]*;|\s)/,
        value = this.element.getValue() || '',
        title = this.element.readAttribute('title') || '';
    return value.replace(whitespace_regex, '') == title.replace(whitespace_regex, '');
  },

  focusout: function(event) {
    if (this.element.getValue().blank()) {
      this.setPrompt();
    }
  },

  focusin: function(event) {
    if(this.defaultPromptEnabled()) {
        this.clearPrompt();
    }
  },

  handleFormSubmission: function(event) {
    var element = event.element();
    if (element.match('input[type=submit]') || element.match('button[type=submit]') || element.match('input[type=image]') || element.match('button[type=submit] span') ) {
      if(this.defaultPromptEnabled()) {
        this.clearPrompt();
      }
    }
  },

  keyup: function(event) { this.changed = true; },
  change: function(event) { this.element.removeClassName('prompting'); this.changed = true; }

});


$(function() {
  $('input.prompting_field, textarea.prompting_field').PromptingField();
});
