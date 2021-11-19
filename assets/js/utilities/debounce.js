export const debounce = (func, wait = 200) => {
  let timer = null;
  return () => {
    clearTimeout(timer);
    timer = setTimeout(func, wait);
  }
}