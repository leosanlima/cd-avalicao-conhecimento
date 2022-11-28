const LOADING_BAR_SELECTOR = '#loading-bar';

const getLoadingBar = () => document.querySelector(LOADING_BAR_SELECTOR);

export const showLoadingBar = () => {
    const loadingBar = getLoadingBar();
    if (!loadingBar) {
        throw new Error('Cannot show loading bar, loading bar not found');
    }

    loadingBar.classList.remove('invisible');
}

export const hideLoadingBar = () => {
    const loadingBar = getLoadingBar();
    if (!loadingBar) {
        throw new Error('Cannot hide loading bar, loading bar not found');
    }

    loadingBar.classList.add('invisible');
}

const loadingBar = {
    hide: hideLoadingBar,
    show: showLoadingBar,
}

export default loadingBar;
