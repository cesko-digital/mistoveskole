export default class ParseError extends Error {
  constructor(message, error) {
    super(message);

    this.error = error;
  }
}
