/**
 * Overload Mustache render
 * for auto templates reading  
 */

(function(m) {
	var oldRender = m.render;
	m.render = function(tpl) {
		if(m.compiled[tpl]) {
			arguments[0] = m.compiled[tpl];
		}
		return oldRender.apply(this, arguments);
	}
})(Mustache);