export default function(start, end) {
  if (end <= start) {
    throw new Error('end must be bigger than start');
  }

  return new Array(end - start + 1).fill(undefined).map((_, i) => i + start);
}
