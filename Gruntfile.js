module.exports = function(grunt) {

    grunt.initConfig({
        compress: {
            main: {
                options: {
                    archive: 'tbpatchuno.zip'
                },
                files: [
                    {src: ['controllers/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['classes/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['docs/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['files/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['override/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['translations/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['upgrade/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['optionaloverride/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['oldoverride/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['defaultoverride/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: ['views/**'], dest: 'tbpatchuno/', filter: 'isFile'},
                    {src: 'config.xml', dest: 'tbpatchuno/'},
                    {src: 'index.php', dest: 'tbpatchuno/'},
                    {src: 'tbpatchuno.php', dest: 'tbpatchuno/'},
                    {src: 'logo.png', dest: 'tbpatchuno/'},
                    {src: 'logo.gif', dest: 'tbpatchuno/'}
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compress');

    grunt.registerTask('default', ['compress']);
};
