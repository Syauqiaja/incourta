function setupGlobalListeners() {
    if (!window.Echo) {
        setTimeout(setupGlobalListeners, 50);
        return;
    }
    const userId = window.appConfig?.userId;

    if (!userId) {
        console.warn('No authenticated user, skip listener setup');
        return;
    }
    console.info('[CONNECTED]: Connect to global listener');
    console.info(userId)
    window.Echo.private(`admin.${userId}`)
        .listen('.admin.welcome', (e) => {
            console.log('halo')
            Toast.fire({
                icon: 'success',
                title: e.message || 'Success'
            });

        })
}
setupGlobalListeners()