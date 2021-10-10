import colors from 'vuetify/lib/util/colors';

export default {
    dark: false,
    theme: {
        themes: {
            light: {
                primary: '#300032',
                secondary: '#06000a',
                accent: '#c43235',
                error: colors.red,
                info: colors.blue,
                success: colors.teal,
                warning: colors.orange
            }
        }
    },
    icons: {
        iconfont: 'mdi', // mdi, mdiSvg, md, fa, fa4
    }
}