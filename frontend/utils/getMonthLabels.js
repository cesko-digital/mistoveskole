import ucfirst from './ucfirst.js';

const MONTHS_IN_YEAR = 12;

export default function(locale, representation = 'long') {
  const labels = [];

  // Setup intl date formatter
  const options = { month: representation };
  const formatter = new Intl.DateTimeFormat(locale, options);

  // Generate months in user locale
  for (let i = 1; i <= MONTHS_IN_YEAR; ++i) {
    const date = new Date(Date.UTC(1970, i, 0, 0, 0, 0));
    const formatted = formatter.format(date);
    labels.push(ucfirst(formatted));
  }

  return labels;
}
