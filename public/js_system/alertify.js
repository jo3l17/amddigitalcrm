function abrir_modal(nombre, title) {
    alertify.dialog(nombre, function () {
        return {
            main: function (content) {
                this.setContent(content);
            },
            setup: function () {
                return {
                    focus: {
                        element: function () {
                            return this.elements.body.querySelector(this.get('selector'));
                        },
                        select: true
                    },
                    options: {
                        title: title,
                        modal: true,
                        basic: false,
                        closableByDimmer: false,
                        maximizable: false,
                        resizable: true,
                        padding: true,
                        transition: true,
                        pinnable: true,
                    }
                };
            },
            settings: {
                selector: undefined
            }
        };
    });
}