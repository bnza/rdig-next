// https://docs.cypress.io/api/introduction/api.html

describe("Home page", () => {
  it("Smocking gun tests", () => {
    cy.visit("/");
    cy.get("#app").should("have.class", "v-application");
  });
});
