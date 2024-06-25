export const copyToClipboard = (item) => {
    navigator.clipboard
        .writeText(item)
        .then(() => {
            toast.success("დაკოპირდა", {
                theme: "colored",
                autoClose: 1000,
            });
            // You can add any success message or actions here
        })
        .catch((err) => {
            console.error("Error copying text: ", err);
            // You can handle the error here, e.g., show an error message
        });
};
