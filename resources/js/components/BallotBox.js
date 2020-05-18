import axios from 'axios'
import React from 'react'
import ReactDOM from 'react-dom'
import PropTypes from 'prop-types'

class BallotBox extends React.Component {
    constructor (props) {
        super(props)
        this.fetchPoll = this.fetchPoll.bind(this)
        this.handleVote = this.handleVote.bind(this)
        this.showResults = this.showResults.bind(this)
        this.state = {
            isShowingResults: this.props.isShowingResults,
            options: [],
            title: null,
            totalVotes: null,
        }
    }

    fetchPoll () {
        let { options, title, totalVotes } = this.state

        return axios.get(`/api/polls/${this.props.pollId}`)
            .then((response) => {
                options = response.data.data.options
                title = response.data.data.title
                totalVotes = response.data.data.votes.length

                options.forEach((option) => {
                    option.percentage = totalVotes > 0 ? `${Math.round(option.votes.length / response.data.data.votes.length * 100)}%` : '0%'
                })

                this.setState({ options, title, totalVotes })
            })
            .catch((error) => {
                console.error(error)
            })
    }

    handleVote (event) {
        axios.post(this.props.endpointUrl, {
            option_id: event.target.value,
        })
            .then((response) => {
                this.fetchPoll().then(() => {
                    this.showResults()
                })
            })
            .catch((error) => {
                console.error(error)
            })
    }

    showResults () {
        this.setState({ isShowingResults: true })
    }

    componentDidMount () {
        this.fetchPoll()
    }

    render () {
        return (
            <div>
                {this.state.isShowingResults ? (
                    <table className="block">
                        <caption className="sr-only">{this.state.title}</caption>
                        <thead className="sr-only">
                            <tr>
                                <th scope="col">Option Name</th>
                                <th scope="col">Percentage Voted For</th>
                            </tr>
                        </thead>
                        <tbody className="block">
                            {this.state.options.map((option) =>
                                <tr key={option.id} className="flex justify-between pl-12 pr-4 py-4 mb-4 rounded-full bg-gray-300" style={{ background: this.state.isShowingResults ? `linear-gradient(to right, #bcf0da ${option.percentage}, #d2d6dc ${option.percentage}` : '#d2d6dc' }}>
                                    <td>{option.name}</td>
                                    <td>{option.percentage}</td>
                                </tr>,
                            )}
                        </tbody>
                    </table>
                ) : (
                    <form action={this.props.endpointUrl} method="POST">
                        <fieldset>
                            <legend className="sr-only">{this.state.title}</legend>
                            {this.state.options.map((option) =>
                                <label key={option.id} className="relative block pl-12 pr-4 py-4 mb-4 rounded-full bg-gray-300 cursor-pointer" htmlFor={option.id}>
                                    <input className="appearance-none fancy-radio-button" id={option.id} name="option_id" type="radio" value={option.id} onChange={this.handleVote} />
                                    <span>{option.name}</span>
                                    {this.state.isShowingResults &&
                                        <span>{option.percentage}</span>
                                    }
                                </label>,
                            )}
                        </fieldset>

                        <button className="sr-only" type="submit">Cast Your Vote</button>
                    </form>
                )}
            </div>
        )
    }
}

BallotBox.propTypes = {
    endpointUrl: PropTypes.string.isRequired,
    isShowingResults: PropTypes.string.isRequired,
    pollId: PropTypes.string.isRequired,
}

const element = document.getElementById('ballot-box')

if (element) {
    const props = Object.assign({}, element.dataset)

    ReactDOM.render(<BallotBox {...props} />, element)
}
