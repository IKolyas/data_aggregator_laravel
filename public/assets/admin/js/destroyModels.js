function destroyModel(models, id) {
    swal({
        title: 'Удаление элемента!',
        text: 'Вы действительно хотите удалить этот элемент?',
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            axios.post(models + '/' + id, {
                _method: 'delete',
            }).then((response) => {
                if (response.status === 200) {
                    swal("Элемент успешно удалён", {
                        icon: "success"
                    })
                        .then(() => window.location.reload())
                } else {
                    swal("Ошибка при удалении элемента!");
                }
            })
        }
    });
}
