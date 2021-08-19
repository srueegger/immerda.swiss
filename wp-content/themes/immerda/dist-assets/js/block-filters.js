function myColumnBgColorOptions( bgColorOptions ) {
	bgColorOptions.push( {
		name: 'black',
		color: '#000000',
	} );
	return bgColorOptions;
}
wp.hooks.addFilter(
	'wpBootstrapBlocks.column.bgColorOptions',
	'myplugin/wp-bootstrap-blocks/column/bgColorOptions',
	myColumnBgColorOptions
);