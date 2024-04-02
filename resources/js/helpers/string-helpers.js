export const limitText = (text, max = null, elipsis = '...') => {
    text = text || '';
    text = `${text}`;
    max = max && parseInt(max) && max > 1 ? parseInt(max) : parseInt(text.length);

    console.log('max', max);
    console.log('text.length', text.length);

    if (!max) {
        return text;
    }

    return (text.length >= max) ? text.slice(0, max) + elipsis : text;
}
